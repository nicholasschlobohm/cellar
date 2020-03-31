<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'catalogues';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $location = $_GET['id'];
    $location = mysqli_real_escape_string($_CELLAR['database'], $location);
    $location = $_CELLAR['database']->query('SELECT * FROM `catalogue` WHERE `id`=\'' . $location . '\';');
    $_LOCATION = $location->fetch_assoc();
    unset($location);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Catalogues</h2>
<?php

if (isset($_LOCATION)) {
    echo ('<h4>' . $_LOCATION['title'] . '</h4>');
    // winery
    $location = $_LOCATION['winery'];
    $location = mysqli_real_escape_string($_CELLAR['database'], $location);
    $location = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $location . '\';');
    $_LOCATION['winery'] = $location->fetch_assoc();
    unset($location);

    ?>
    <p>
		catalogue from <a
			href="wineries.php?id=<?= $_LOCATION['winery']['id']; ?>"><?= $_LOCATION['winery']['name']; ?></a>
	</p>

	<small><a href="upload/catalogue/<?= $_LOCATION['id']; ?>.pdf"
		target="_blank">click here for raw file</a></small>
	<iframe src="upload/catalogue/<?= $_LOCATION['id']; ?>.pdf#toolbar=0"
		width="100%" height="750px"></iframe>
	
    <?php
} else {
    $wineries = $_CELLAR['database']->query('SELECT `id`,`title` FROM `catalogue`;');
    $_WINERIES = array();
    while ($row = mysqli_fetch_assoc($wineries)) {
        $_WINERIES[] = $row;
    }
    unset($wineries);

    foreach ($_WINERIES as $location) {
        ?>
        <a href="?id=<?= $location['id']; ?>"><?= $location['title']; ?></a>
	<br>
        <?php
    }
}

?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
