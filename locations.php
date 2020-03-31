<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'locations';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $location = $_GET['id'];
    $location = mysqli_real_escape_string($_CELLAR['database'], $location);
    $location = $_CELLAR['database']->query('SELECT * FROM `location` WHERE `id`=\'' . $location . '\';');
    $_LOCATION = $location->fetch_assoc();
    unset($location);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Locations</h2>
<?php
if (isset($_LOCATION)) {
    echo ('<h4>' . $_LOCATION['address'] . '</h4>');
    ?>
    <br>	
	<?php
    if ($_CELLAR['gmaps_embed_enabled']) {
        ?>
	<iframe width="65%" height="450" frameborder="0" style="border: 0"
		src="https://www.google.com/maps/embed/v1/place?q=<?= htmlspecialchars($_LOCATION['address']); ?>&maptype=<?= htmlspecialchars($_CELLAR['gmaps_embed_view']); ?>&key=<?= htmlspecialchars($_CELLAR['gmaps_embed_apikey']); ?>"
		allowfullscreen></iframe>
	<br>
	<?php
    } else {
        ?>
        <p>
		<a
			href="https://google.com/maps/search/<?= htmlspecialchars($_LOCATION['address']); ?>">view
			on map</a>
	</p>
        <?php
    }
    ?>
<?php
} else {
    $wineries = $_CELLAR['database']->query('SELECT `id`,`address` FROM `location`;');
    $_WINERIES = array();
    while ($row = mysqli_fetch_assoc($wineries)) {
        $_WINERIES[] = $row;
    }
    unset($wineries);

    foreach ($_WINERIES as $location) {
        ?>
        <a href="?id=<?= $location['id'] ?>"><?= $location['address'] ?></a>
	<br>
        <?php
    }
}

?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
