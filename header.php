<!doctype html>
<html lang="en">
<head>
<title><?= ucwords($_CELLAR['page_title']); ?> &#183; cellar</title>

<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
<link href="vendor/select2/select2/dist/css/select2.min.css"
	rel="stylesheet">
<link href="vendor/components/font-awesome/css/all.min.css"
	rel="stylesheet">

<style>
body {
	font-size: .875rem;
}

.feather {
	width: 16px;
	height: 16px;
	vertical-align: text-bottom;
}

/*
 * Sidebar
 */
.sidebar {
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	z-index: 100; /* Behind the navbar */
	padding: 48px 0 0; /* Height of navbar */
	box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
	position: relative;
	top: 0;
	height: calc(100vh - 48px);
	padding-top: .5rem;
	overflow-x: hidden;
	overflow-y: auto;
	/* Scrollable contents if viewport is shorter than content. */
}

@
supports ((position: -webkit-sticky ) or (position: sticky )) {
	.sidebar-sticky {
	position: -webkit-sticky;
	position: sticky;
}

}
.sidebar .nav-link {
	font-weight: 500;
	color: #333;
}

.sidebar .nav-link .feather {
	margin-right: 4px;
	color: #999;
}

.sidebar .nav-link.active {
	color: #007bff;
}

.sidebar .nav-link:hover .feather, .sidebar .nav-link.active .feather {
	color: inherit;
}

.sidebar-heading {
	font-size: .75rem;
	text-transform: uppercase;
}

/*
 * Content
 */
[role="main"] {
	padding-top: 60px; /* Space for fixed navbar */
}

/*
 * Navbar
 */
.navbar-brand {
	padding-top: .75rem;
	padding-bottom: .75rem;
	font-size: 1rem;
	background-color: rgba(0, 0, 0, .25);
	box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .form-control {
	padding: .75rem 1rem;
	border-width: 0;
	border-radius: 0;
}

.form-control-dark {
	color: #fff;
	background-color: rgba(255, 255, 255, .1);
	border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
	border-color: transparent;
	box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}
</style>
</head>
<body>
	<nav
		class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">cellar</a> <input
			class="form-control form-control-dark w-100" type="text"
			placeholder="Search" aria-label="Search">
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'home' ? " active" : "" ?>"
							href="<?= $_CELLAR['page_title'] == 'home' ? "#" : "index.php" ?>">Home</a></li>
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'about' ? " active" : "" ?>"
							href="<?= ($_CELLAR['page_title'] == 'about' && !$_CELLAR['params']) ? "about.php?more" : "about.php" ?>">About</a></li>
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'racks' ? " active" : "" ?>"
							href="<?= ($_CELLAR['page_title'] == 'racks' && !$_CELLAR['params']) ? "#" : "racks.php" ?>">Racks</a></li>
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'wines' ? " active" : "" ?>"
							href="<?= $_CELLAR['page_title'] == 'wines' ? "#" : "index.php" ?>">Wines</a></li>
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'catalogues' ? " active" : "" ?>"
							href="<?= ($_CELLAR['page_title'] == 'catalogues' && !$_CELLAR['params']) ? "#" : "catalogues.php" ?>">Catalogues</a></li>
						<li class="nav-item"><a
							class="nav-link<?= $_CELLAR['page_title'] == 'wineries' ? " active" : "" ?>"
							href="<?= ($_CELLAR['page_title'] == 'wineries' && !$_CELLAR['params']) ? "#" : "wineries.php" ?>">Wineries</a></li>
					</ul>
				</div>
			</nav>