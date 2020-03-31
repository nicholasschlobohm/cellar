<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'new';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['n']))
    $_NEW['type'] = $_GET['n'];
else
    $_NEW['type'] = 'empty';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>New<?= $_NEW['type'] != 'empty' ? (' ' . ucfirst($_NEW['type'])) : ""; ?></h2>
	<!-- TODO: accordion, with items for wine, beer, spirits, other -->
<?php
if ($_NEW['type'] == 'winery') {
    ?>
	<form action="new_submit.php" method="post" style="max-width: 80%;">
		<input type="hidden" id="type" name="type"
			value="<?= $_NEW['type']; ?>">
		<div class="form-group">
			<label for="name">name <font color="red">(required)</font></label> <input
				type="text" class="form-control" id="name" name="name">
		</div>
		<br>
		<div class="form-group">
			<label for="description">description <font color="grey">(optional)</font></label>
			<textarea class="form-control" id="description" name="description"
				rows="3"></textarea>
		</div>
		<br>
		<div class="form-group">
			<label for="location">location <font color="red">(required)</font></label><br>
			<select class="cellar-select" name="location" style="width: 40%">
			<?php
    $locations = $_CELLAR['database']->query('SELECT `id`,`address` FROM `location`;');
    $_LOCATIONS = array();
    while ($row = mysqli_fetch_assoc($locations)) {
        $_LOCATIONS[] = $row;
    }
    unset($locations);

    foreach ($_LOCATIONS as $location) {
        ?>
        <option value="<?= $location['id']; ?>"><?= $location['address']; ?></option>
        <?php
    }
    unset($_LOCATIONS);
    ?>
    	</select>
		</div>
		<br>
		<div class="form-group">
			<label for="logo">logo URL <font color="grey">(optional)</font></label>
			<input type="text" class="form-control" id="logo" name="logo">
		</div>
		<br>
		<div class="form-group">
			<label for="contact">contact info <font color="grey">(optional)</font></label>
			<textarea class="form-control" id="contact" name="contact" rows="3"></textarea>
		</div>
		<button type="submit" class="btn btn-outline-primary">Create</button>
	</form>
<?php
} else if ($_NEW['type'] == 'wine') {
    ?>
	<form action="new_submit.php" method="post" style="max-width: 80%;">
		<input type="hidden" id="type" name="type"
			value="<?= $_NEW['type']; ?>">
		<div class="form-group">
			<label for="name">name <font color="red">(required)</font></label> <input
				type="text" class="form-control" id="name" name="name">
		</div>
		<br>
		<div class="form-group">
			<label for="year">year <font color="red">(required)</font></label> <input
				type="number" class="form-control" value="<?= date('Y', time()); ?>"
				id="year" name="year">
		</div>
		<br>
		<div class="form-group">
			<label for="category">category <font color="red">(required)</font></label><br>
			<select class="cellar-select" name="category" style="width: 40%">
			<?php
    $categories = $_CELLAR['database']->query('SELECT `id`,`name` FROM `category`;');
    $_CATEGORIES = array();
    while ($row = mysqli_fetch_assoc($categories)) {
        $_CATEGORIES[] = $row;
    }
    unset($categories);

    $tmp = isset($_GET['category']) ? $_GET['category'] : 'null';
    foreach ($_CATEGORIES as $category) {
        ?>
        <option value="<?= $category['id']; ?>"
					<?= ($category['id'] === $tmp ? " selected" : ""); ?>><?= $category['name']; ?></option>
        <?php
    }
    unset($_CATEGORIES);
    unset($tmp);
    ?>
    	</select>
		</div>
		<br>
		<div class="form-group">
			<label for="winery">winery <font color="red">(required)</font></label><br>
			<select class="cellar-select" name="winery" style="width: 40%">
			<?php
    $wineries = $_CELLAR['database']->query('SELECT `id`,`name` FROM `winery`;');
    $_WINERIES = array();
    while ($row = mysqli_fetch_assoc($wineries)) {
        $_WINERIES[] = $row;
    }
    unset($wineries);

    $tmp = isset($_GET['winery']) ? $_GET['winery'] : 'null';
    foreach ($_WINERIES as $winery) {
        ?>
        <option value="<?= $winery['id']; ?>"
					<?= ($winery['id'] === $tmp ? " selected" : ""); ?>><?= $winery['name']; ?></option>
        <?php
    }
    ?>
    	</select>
		</div>
		<br>
		<div class="form-group">
			<label for="description">description <font color="grey">(optional)</font></label>
			<textarea class="form-control" id="description" name="description"
				rows="3"></textarea>
		</div>
		<br>
		<button type="submit" class="btn btn-outline-primary">Create</button>
	</form>
<?php
} else if ($_NEW['type'] == 'bottle') {
    // NEW BOTTLE
} else if ($_NEW['type'] == 'catalogue') {
    // NEW CATALOGUE
} else if ($_NEW['type'] == 'rack') {
    // NEW RACK
} else if ($_NEW['type'] == 'location') {
    ?>
	<form action="new_submit.php" method="post" style="max-width: 80%;">
		<input type="hidden" id="type" name="type"
			value="<?= $_NEW['type']; ?>">
		<div class="form-group">
			<label for="address">address <font color="red">(required)</font></label>
			<textarea class="form-control" id="address" name="address" rows="2"></textarea>
		</div>
		<button type="submit" class="btn btn-outline-primary">Create</button>
	</form>
<?php
} else {
    ?>
	<br>
	<h4>
		<a href="?n=winery">Winery</a>
	</h4>
	<br>
	<h4>
		<a href="?n=wine">Wine</a>
	</h4>
	<br>
	<h4>
		<a href="?n=bottle">Bottle</a>
	</h4>
	<br>
	<h4>
		<a href="?n=catalogue">Catalogue</a>
	</h4>
	<br>
	<h4>
		<a href="?n=rack">Rack</a>
	</h4>
	<br>
	<h4>
		<a href="?n=location">Location</a>
	</h4>
<?php
}
?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
<script>
$(document).ready(function() {
	$('.cellar-select').select2();
});
</script>
