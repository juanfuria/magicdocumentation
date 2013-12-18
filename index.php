<?php
include_once('functions.php');
include_once('objects.php');

$FILES_DIR = "files";
$selfUrl = filter_input(INPUT_SERVER, "PHP_SELF");
$BASE_URL = getStringBeforeLast($selfUrl, "/");


$dirs = listDirs($FILES_DIR);
$platforms = array();

foreach ($dirs as $path) {
    $platforms[count($platforms)] = getStringAfterLast($path, "/");
}
if (count($platforms) == 0) {
    die;
}
$requestedPos = false;
$requestedPlatform = filter_input(INPUT_GET, "platform");
if (isset($requestedPlatform)) {
    $requestedPos = array_search($requestedPlatform, $platforms);
}

$selectedPlatform = ($requestedPos) ? $platforms[$requestedPos] : $platforms[0];

$documentation = new Documentation($FILES_DIR . "/" . $selectedPlatform);

$requestedSection = filter_input(INPUT_GET, "section");
$selectedSection  = (isset($requestedSection)) ? $requestedSection : "Introduction"; 
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <meta http-equiv="refresh" content="5; URL="> -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <title></title>
        <style>
            body{padding-top: 80px;}
        </style>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Handpoint SDK</a>
                    <ul class="nav navbar-nav">
<?php
foreach ($platforms as $value) {
    if ($value == $selectedPlatform) {
        $addon = ' class="active"';
    } else {
        $addon = '';
    }

    echo '<li' . $addon . '><a href="' . $BASE_URL . '/platform/' . $value . '">' . $value . '</a></li>';
}
?>      
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-3">
                    <ul class="list-group">
                        <?php 
                        $documentation->printMenu($BASE_URL . "/platform/" . $selectedPlatform);
                        ?>
                    </ul>
                </div>
                <div class="col-md-8">
                    <?php
                        $documentation->printSectionContent($selectedSection);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
