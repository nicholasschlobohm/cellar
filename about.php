<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');
$_CELLAR['page_title'] = 'about';
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'header.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<h2>About</h2>
	<br>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td><b>Version</b></td>
				<td><?= CELLAR_VERSION ?></td>
			</tr>
			<tr>
				<td><b>Hostname</b></td>
				<td><?= $_SERVER['SERVER_NAME'] ?></td>
			</tr>
			<tr>
				<td><b>Running on</b></td>
				<td><?= $_SERVER['SERVER_SOFTWARE'] ?></td>
			</tr>
			<?php
if (isset($_GET['more'])) {
    ?>
			<tr>
				<td><b>Server protocol</b></td>
				<td><?= $_SERVER['SERVER_PROTOCOL'] ?></td>
			</tr>
			<tr>
				<td><b>Document root</b></td>
				<td><?= $_SERVER['DOCUMENT_ROOT'] ?></td>
			</tr>			
			<?php
}
?>
		</tbody>
	</table>

</main>
<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'footer.php');
?>
