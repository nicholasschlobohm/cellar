<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'catalogues';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $catalogue = $_GET['id'];
    $catalogue = mysqli_real_escape_string($_CELLAR['database'], $catalogue);
    $catalogue = $_CELLAR['database']->query('SELECT * FROM `catalogue` WHERE `id`=\'' . $catalogue . '\';');
    $_CATALOGUE = $catalogue->fetch_assoc();
    unset($catalogue);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Catalogues</h2>
<?php

if (isset($_CATALOGUE)) {
    echo ('<h4>' . $_CATALOGUE['title'] . '</h4>');
    // winery
    $winery = $_CATALOGUE['winery'];
    $winery = mysqli_real_escape_string($_CELLAR['database'], $winery);
    $winery = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $winery . '\';');
    $_CATALOGUE['winery'] = $winery->fetch_assoc();
    unset($winery);

    ?>
    <p>
		catalogue from <a
			href="wineries.php?id=<?= $_CATALOGUE['winery']['id'] ?>"><?= $_CATALOGUE['winery']['name'] ?></a>
	</p>

	<small><a href="upload/catalogue/<?= $_CATALOGUE['id'] ?>.pdf"
		target="_blank">click here for raw file</a></small>
	<iframe src="upload/catalogue/<?= $_CATALOGUE['id'] ?>.pdf#toolbar=0"
		width="100%" height="750px"></iframe>
	
    <?php
} else {
    $catalogues = $_CELLAR['database']->query('SELECT `id`,`title` FROM `catalogue`;');
    $_CATALOGUES = array();
    while ($row = mysqli_fetch_assoc($catalogues)) {
        $_CATALOGUES[] = $row;
    }
    unset($catalogues);

    foreach ($_CATALOGUES as $catalogue) {
        ?>
        <a href="?id=<?= $catalogue['id'] ?>"><?= $catalogue['title'] ?></a>
	<br>
        <?php
    }
}

?>


</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
