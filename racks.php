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
        $winery = $_RACK['bottles'][$i]['wine']['winery'];
        $winery = mysqli_real_escape_string($_CELLAR['database'], $winery);
        $winery = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $winery . '\';');
        $_RACK['bottles'][$i]['wine']['winery'] = $winery->fetch_assoc();
        unset($winery);

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
<p>
		<a href="#" data-toggle="modal"
			data-target=".bottle-modal-<?= $_BOTTLE['id'] ?>"><?= $_BOTTLE['wine']['year'] . ' ' . $_BOTTLE['wine']['name'] ?></a>
	</p>

	<div class="modal fade bottle-modal-<?= $_BOTTLE['id'] ?>"
		tabindex="-1" role="dialog" aria-labelledby="<?= $_BOTTLE['id'] ?>"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel"><?= $_BOTTLE['wine']['year'] . ' ' . $_BOTTLE['wine']['name'] ?></h4>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>
						from <a
							href="wineries.php?id=<?= $_BOTTLE['wine']['winery']['id'] ?>"><?= $_BOTTLE['wine']['winery']['name'] ?></a>
					</p>
					<h3>
						<a href="bottlelabel.php?id=<?= $_BOTTLE['id'] ?>" style="text-decoration: none !important; color: <?= BottleLabel::getColour($_BOTTLE['id']) ?> !important;" target="_blank"><?= BottleLabel::getNumber($_BOTTLE['id'])?></a>

					</h3>
					<blockquote class="blockquote"><?= $_BOTTLE['wine']['description'] ?></blockquote>
				</div>
			</div>
		</div>
	</div>
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
