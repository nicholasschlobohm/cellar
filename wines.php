<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'wines';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $wine = $_GET['id'];
    $wine = mysqli_real_escape_string($_CELLAR['database'], $wine);
    $wine = $_CELLAR['database']->query('SELECT * FROM `wine` WHERE `id`=\'' . $wine . '\';');
    $_WINE = $wine->fetch_assoc();
    unset($wine);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Wines</h2>
<?php
if (isset($_WINE)) {
    echo ('<h4>' . $_WINE['name'] . '</h4>');
    // winery
    $winery = $_WINE['winery'];
    $winery = mysqli_real_escape_string($_CELLAR['database'], $winery);
    $winery = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $winery . '\';');
    $_WINE['winery'] = $winery->fetch_assoc();
    unset($winery);

    ?>
    <p>
		wine from <a href="wineries.php?id=<?= $_WINE['winery']['id']; ?>"><?= $_WINE['winery']['name']; ?></a>
	</p>
	<br> <a href="new.php?n=catalogue&winery=<?= $_WINE['id']; ?>"
		class="btn btn-outline-primary"> <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Bottle of <?= $_WINE['name']; ?></a>
	
<?php
} else {
    $wines = $_CELLAR['database']->query('SELECT `wine`.`id` AS `id`, `wine`.`name` AS `name`, `winery`.`name` AS `winery` FROM `wine` JOIN `winery` ON `wine`.`winery`=`winery`.`id`;');
    $_WINES = array();
    while ($row = mysqli_fetch_assoc($wines)) {
        $_WINES[] = $row;
    }
    unset($wines);

    foreach ($_WINES as $wine) {
        ?>
        <a href="?id=<?= $wine['id']; ?>"><?= $wine['name']; ?> (<?= $wine['winery']; ?>)</a>
	<br>
        <?php
    }
}
?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
