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
<html>
    <head>
        <meta charset="UTF-8">
<!--        <meta http-equiv="refresh" content="5; URL=">-->

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BASE_URL . "/"; ?>css/solarized_light.css">
        <script src="<?php echo $BASE_URL . "/"; ?>js/highlight.pack.js"></script>
        <title>coso</title>
        <style>
            body{padding-top: 80px;}
            .badge {
                color: #428bca;
                background-color: #fff;
            }
            section{
                padding-top: 40px;
                border-bottom: 1px solid #eee8d5;
                padding-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <script>hljs.initHighlightingOnLoad();</script>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SDK</a>
                    <ul class="nav navbar-nav">
<?php
foreach ($platforms as $value) {
    if ($value == $selectedPlatform) {
        $addon = ' class="active"';
    } else {
        $addon = '';
    }

    echo '<li' . $addon . '><a href="' . $BASE_URL . '?platform=' . $value.' >' . $value.'</a></li>';
}
?>      
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-2">
                    <ul class="list-group">
                        <?php 
                        $documentation->printMenu($BASE_URL . "/platform/" . $selectedPlatform);
                        ?>
                    </ul>
                </div>
                <div class="col-md-9">
                    <?php
                        $documentation->printall();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
