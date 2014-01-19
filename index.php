<?php
include_once('framework/php/Framework.php');


$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;

/** @var $documentation Documentation */
$documentation = $framework->getDocumentation($framework->getSelectedPlatform());
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--        <meta http-equiv="refresh" content="5; URL=">-->

    <?php

    echo $framework->printCssHeaders();

    echo $framework->printJavaScriptHeaders();

    ?>
    <title><?php echo $settings->pageTitle; ?></title>
    <style>
        body{
            padding-top: 50px;
            height: 100%;
        }

     </style>
</head>
<body>
<script>hljs.initHighlightingOnLoad();</script>
<?php
$framework->printNavBar();
?>
<div id="header-bar"></div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2 menu">
            <?php
            $framework->printMenu();
            ?>
        </div>
        <div class="col-md-10 content">
            <div class="letter">
            <?php
            print_r($_POST);
            $documentation->printall();
            ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
