<?php
require_once (__DIR__ . DIRECTORY_SEPARATOR . 'cellar.php');

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type == 'winery') {
        // NEW WINERY
        if (isset($_POST['name']) && isset($_POST['location'])) {
            $id = mysqli_real_escape_string($_CELLAR['database'], GUID());

            // name
            $name = mysqli_real_escape_string($_CELLAR['database'], $_POST['name']);

            // logo
            if (isset($_POST['logo']) && ! empty($_POST['logo']) && $_POST['logo'] != '') {
                $logo = mysqli_real_escape_string($_CELLAR['database'], $_POST['logo']);
            } else {
                $logo = '';
            }

            // contact
            if (isset($_POST['contact']) && ! empty($_POST['contact']) && $_POST['contact'] != '') {
                $contact = mysqli_real_escape_string($_CELLAR['database'], $_POST['contact']);
            } else {
                $contact = '';
            }

            // description
            if (isset($_POST['description']) && ! empty($_POST['description']) && $_POST['description'] != '') {
                $description = mysqli_real_escape_string($_CELLAR['database'], $_POST['description']);
            } else {
                $description = '';
            }

            // location
            $location = mysqli_real_escape_string($_CELLAR['database'], $_POST['location']);

            $query = 'INSERT INTO `winery` (`id`, `name`, `logo`, `contact`, `description`, `location`) VALUES (\'' . $id . '\', \'' . $name . '\', \'' . $logo . '\', \'' . $contact . '\', \'' . $description . '\', \'' . $location . '\');';
            if ($_CELLAR['database']->query($query) === TRUE) {
                header('Location: index.php');
                echo 'New record created successfully. Click <a href="index.php>here</a> if you are not redirected."';
            } else {
                echo 'Error while executing the following code:<br><pre>' . $query . '</pre><br>Error: <pre>' . $_CELLAR['database']->error . '</pre>';
            }
            unset($id);
            unset($name);
            unset($logo);
            unset($contact);
            unset($description);
            unset($location);
            unset($query);
        } else {
            // header('Location: new.php?n=location');
            echo 'Error: You have not filled all required fields! Click <a href="new.php?n=winery">here</a> to be redirected.';
        }
    } else if ($type == 'wine') {
        // NEW WINE
        if (isset($_POST['winery']) && isset($_POST['name']) && isset($_POST['year']) && isset($_POST['category'])) {
            $id = mysqli_real_escape_string($_CELLAR['database'], GUID());

            // winery
            $winery = mysqli_real_escape_string($_CELLAR['database'], $_POST['winery']);

            // name
            $name = mysqli_real_escape_string($_CELLAR['database'], $_POST['name']);

            // year
            $year = mysqli_real_escape_string($_CELLAR['database'], $_POST['year']);

            // type = wine

            // category
            $category = mysqli_real_escape_string($_CELLAR['database'], $_POST['category']);

            // description
            if (isset($_POST['description']) && ! empty($_POST['description']) && $_POST['description'] != '') {
                $description = mysqli_real_escape_string($_CELLAR['database'], $_POST['description']);
            } else {
                $description = '';
            }

            $query = 'INSERT INTO `wine` (`id`, `winery`, `name`, `year`, `type`, `category`, `description`) VALUES (\'' . $id . '\', \'' . $winery . '\', \'' . $name . '\', \'' . $year . '\', \'wine\', \'' . $category . '\', \'' . $description . '\');';
            if ($_CELLAR['database']->query($query) === TRUE) {
                header('Location: index.php');
                echo 'New record created successfully. Click <a href="index.php">here</a> if you are not redirected.';
            } else {
                echo 'Error while executing the following code:<br><pre>' . $query . '</pre><br>Error: <pre>' . $_CELLAR['database']->error . '</pre>';
            }
            unset($id);
            unset($winery);
            unset($name);
            unset($year);
            unset($category);
            unset($description);
            unset($query);
        } else {
            var_dump($_POST);
            // header('Location: new.php?n=location');
            echo 'Error: You have not filled all required fields! Click <a href="new.php?n=winery">here</a> to be redirected.';
        }
    } else if ($type == 'bottle') {
        // NEW BOTTLE
    } else if ($type == 'location') {
        // NEW CATALOGUE
        // INSERT INTO `catalogue` (`id`, `title`, `published`, `winery`)
    } else if ($type == 'rack') {
        // NEW RACK
    } else if ($type == 'location') {
        // NEW LOCATION
        if (isset($_POST['address'])) {
            $id = mysqli_real_escape_string($_CELLAR['database'], GUID());
            $address = mysqli_real_escape_string($_CELLAR['database'], $_POST['address']);
            $query = 'INSERT INTO `location` (`id`, `address`) VALUES (\'' . $id . '\', \'' . $address . '\');';
            if ($_CELLAR['database']->query($query) === TRUE) {
                header('Location: index.php');
                echo 'New record created successfully. Click <a href="index.php">here</a> if you are not redirected.';
            } else {
                echo 'Error while executing the following code:<br><pre>' . $query . '</pre><br>Error: <pre>' . $_CELLAR['database']->error . '</pre>';
            }
            unset($id);
            unset($address);
            unset($query);
        } else {
            header('Location: new.php?n=location');
            echo 'Error: You need to input an address! Click <a href="new.php?n=location">here</a> if you are not redirected.';
        }
    }

    unset($type);
}