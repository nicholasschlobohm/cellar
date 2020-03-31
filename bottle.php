<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'bottle';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');

// page logic
if (isset($_GET['id'])) {
    $bottle = $_GET['id'];
    $bottle = mysqli_real_escape_string($_CELLAR['database'], $bottle);
    $bottle = $_CELLAR['database']->query('SELECT * FROM `bottle` WHERE `id`=\'' . $bottle . '\';');
    $_BOTTLE = $bottle->fetch_assoc();
    unset($bottle);

    $wine = $_BOTTLE['wine'];
    $wine = mysqli_real_escape_string($_CELLAR['database'], $wine);
    $wine = $_CELLAR['database']->query('SELECT * FROM `wine` WHERE `id`=\'' . $wine . '\';');
    $_BOTTLE['wine'] = $wine->fetch_assoc();
    unset($wine);

    $category = $_BOTTLE['wine']['category'];
    $category = mysqli_real_escape_string($_CELLAR['database'], $category);
    $category = $_CELLAR['database']->query('SELECT * FROM `category` WHERE `id`=\'' . $category . '\';');
    $_BOTTLE['wine']['category'] = $category->fetch_assoc();
    unset($category);

    $winery = $_BOTTLE['wine']['winery'];
    $winery = mysqli_real_escape_string($_CELLAR['database'], $winery);
    $winery = $_CELLAR['database']->query('SELECT * FROM `winery` WHERE `id`=\'' . $winery . '\';');
    $_BOTTLE['wine']['winery'] = $winery->fetch_assoc();
    unset($wine);

    $rack = $_BOTTLE['rack'];
    $rack = mysqli_real_escape_string($_CELLAR['database'], $rack);
    $rack = $_CELLAR['database']->query('SELECT * FROM `rack` WHERE `id`=\'' . $rack . '\';');
    $_BOTTLE['rack'] = $rack->fetch_assoc();
    unset($wine);
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>Bottle</h2>
<?php
if (isset($_BOTTLE)) {
    echo ('<h4>' . $_BOTTLE['wine']['name'] . '</h4>');
    ?>
    <p>
		wine from <a
			href="wineries.php?id=<?= $_BOTTLE['wine']['winery']['id']; ?>"><?= $_BOTTLE['wine']['winery']['name']; ?></a>
	</p>
	<br>
	<blockquote class="blockquote"><?= $_BOTTLE['wine']['description']; ?>
	</blockquote>
	<br>
	<table class="table" style="width: 500px;">
		<tbody>
			<tr>
				<td><b>Purchased</b></td>
				<td><?= date_format(date_create_from_format('Y-m-d', $_BOTTLE['purchased']), 'j F Y'); ?></td>
			</tr>
			<tr>
				<td><b>Drink 'til</b></td>
				<td><?= $_BOTTLE['til']; ?></td>
			</tr>
			<tr>
				<td><b>Purchased for</b></td>
				<td><?= $_CELLAR['currency_symbol'] . $_BOTTLE['price']; ?></td>
			</tr>
		</tbody>
	</table>
	<br> <a href="new.php?n=catalogue&winery=<?= $_BOTTLE['id']; ?>"
		class="btn btn-outline-primary"> <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;New Bottle of <?= $_BOTTLE['wine']['name']; ?></a>
	
<?php
} else {
    ?>
    <br> <br>
	<h3>Oops!</h3>
	<p>
		Looks like there's an error. Click <a href="index.php">here</a> to be
		redirected to the homepage.
	</p>
    <?php
}
?>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
