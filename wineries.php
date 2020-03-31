<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'wineries';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $winery = $_GET['id'];
    $winery = mysqli_real_escape_string($_CELLAR['database'], $winery);
    $winery = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $winery . '\';');
    $_LOCATION = $winery->fetch_assoc();
    unset($winery);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Wineries</h2>
<?php
if (isset($_LOCATION)) {
    echo ('<h4>' . $_LOCATION['name'] . '</h4>');
    // location
    $location = $_LOCATION['location'];
    $location = mysqli_real_escape_string($_CELLAR['database'], $location);
    $location = $_CELLAR['database']->query('SELECT * FROM `location` WHERE `id`=\'' . $location . '\';');
    $_LOCATION['location'] = $location->fetch_assoc();
    unset($location);
    ?>
    <br>
	<?php
    if (isset($_LOCATION['logo'])) {
        echo ('<img src="' . $_LOCATION['logo'] . '" style="width: 100%; max-width: 120px;" /><br><br>');
    }
    ?>
	
	<?php
    if ($_CELLAR['gmaps_embed_enabled']) {
        ?>
	<iframe width="65%" height="450" frameborder="0" style="border: 0"
		src="https://www.google.com/maps/embed/v1/place?q=<?= htmlspecialchars($_LOCATION['location']['address']); ?>&maptype=<?= htmlspecialchars($_CELLAR['gmaps_embed_view']); ?>&key=<?= htmlspecialchars($_CELLAR['gmaps_embed_apikey']); ?>"
		allowfullscreen></iframe>
	<br>
	<?php
    } else {
        ?>
        <p>
		<a
			href="https://google.com/maps/search/<?= htmlspecialchars($_LOCATION['location']['address']); ?>">view
			on map</a>
	</p>
        <?php
    }
    ?>
    <small><a
		href="locations.php?id=<?= $_LOCATION['location']['id']; ?>">view
			location in cellar</a></small>
<?php
} else {
    $wineries = $_CELLAR['database']->query('SELECT `id`,`name` FROM `winery`;');
    $_WINERIES = array();
    while ($row = mysqli_fetch_assoc($wineries)) {
        $_WINERIES[] = $row;
    }
    unset($wineries);

    foreach ($_WINERIES as $winery) {
        ?>
        <a href="?id=<?= $winery['id'] ?>"><?= $winery['name'] ?></a> <br>
        <?php
    }
}

?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
