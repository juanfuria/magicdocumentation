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

    echo $framework->getFormattedCSSList();

    echo $framework->getFormattedJavaScriptList();

    ?>
    <title><?php echo $settings->pageTitle; ?></title>
    <style>
        body{
            padding-top: 70px;
            background: #dfdfdf;
        }
     </style>
</head>
<body>
<script>hljs.initHighlightingOnLoad();</script>
<?php
$framework->printNavBar();
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-2">
            <?php
            $documentation->printMenu($framework->settings->getBaseUrl() . "/platform/" . $framework->getSelectedPlatform());
            ?>
        </div>
        <div class="col-md-10">
            <div class="letter">
            <?php
            $documentation->printall();
            ?>
            </div>
            <div class="shadow-separator"></div>
        </div>
    </div>
</div>
</body>
</html>
