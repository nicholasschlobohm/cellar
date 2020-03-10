<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'racks';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $rack = $_GET['id'];
    $rack = mysqli_real_escape_string($_CELLAR['database'], $rack);
    $rack = $_CELLAR['database']->query('SELECT * FROM `rack` WHERE `id`=\'' . $rack . '\';');
    $_RACK = $rack->fetch_assoc();
    unset($rack);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h2>racks</h2>
<?php

if (isset($_RACK)) {
    echo ('<h4>' . $_RACK['name'] . '</h4>');
    $_RACK['capacity'] = (int) $_RACK['width'] * (int) $_RACK['height'];

    $_RACK['bottles'] = array();
    $bottles = $_CELLAR['database']->query('SELECT * FROM `bottle` WHERE `rack`=\'' . $_RACK['id'] . '\';');
    while ($row = mysqli_fetch_assoc($bottles)) {
        $_RACK['bottles'][] = $row;
    }
    unset($row);
    unset($bottles);

    for ($i = 0; $i < count($_RACK['bottles']); $i ++) {
        // BOTTLES
        $wine = $_RACK['bottles'][$i]['wine'];
        $wine = mysqli_real_escape_string($_CELLAR['database'], $wine);
        $wine = $_CELLAR['database']->query('SELECT * FROM `wine` WHERE `id`=\'' . $wine . '\';');
        $_RACK['bottles'][$i]['wine'] = $wine->fetch_assoc();
        unset($wine);

        // winery
        $location = $_RACK['bottles'][$i]['wine']['winery'];
        $location = mysqli_real_escape_string($_CELLAR['database'], $location);
        $location = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $location . '\';');
        $_RACK['bottles'][$i]['wine']['winery'] = $location->fetch_assoc();
        unset($location);

        // location
        $location = $_RACK['bottles'][$i]['wine']['winery']['location'];
        $location = mysqli_real_escape_string($_CELLAR['database'], $location);
        $location = $_CELLAR['database']->query('SELECT * FROM `location` WHERE `id`=\'' . $location . '\';');
        $_RACK['bottles'][$i]['wine']['winery']['location'] = $location->fetch_assoc();
        unset($location);
    }
    ?>
    <p>Capacity: <?= $_RACK['capacity'] ?> bottles</p>
<h5>Bottles</h5>
    <?php
    foreach ($_RACK['bottles'] as $_BOTTLE) {
        ?>
        <span data-toggle="tooltip" data-placement="right"
	title="<?= $_BOTTLE['wine']['description'] ?>"><?= $_BOTTLE['wine']['year'] ?> <?= $_BOTTLE['wine']['name'] ?> (<?= $_BOTTLE['wine']['winery']['name'] ?>)</a>
        <?php
    }
} else {
    $racks = $_CELLAR['database']->query('SELECT `id`,`name` FROM `rack`;');
    $_RACKS = array();
    while ($row = mysqli_fetch_assoc($racks)) {
        $_RACKS[] = $row;
    }
    unset($racks);

    foreach ($_RACKS as $rack) {
        ?>
        <a href="?id=<?= $rack['id'] ?>"><?= $rack['name']?></a> <br>
        <?php
    }
}

?>
</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
