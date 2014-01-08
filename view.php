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
            background: #eee;
        }
        .badge {
            color: #428bca;
            background-color: #fff;
        }
        section{
            padding-top: 40px;
            border-bottom: 1px solid #eee8d5;
            padding-bottom: 40px;
        }
        .letter {
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            margin: 26px auto 0;
            min-height: 300px;
            padding: 0 24px 24px 24px;
            position: relative;
            width: 100%;
        }
        .letter:before, .letter:after {
            content: "";
            height: 100%;
            position: absolute;
            width: 100%;
            z-index: -1;
        }
        .letter:before {
            background: #fafafa;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            left: -5px;
            top: 4px;
            transform: rotate(-2.5deg);
        }
        .letter:after {
            background: #f6f6f6;
            box-shadow: 0 0 3px rgba(0,0,0,0.2);
            right: -3px;
            top: 1px;
            transform: rotate(1.4deg);
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
            $documentation->printMenu($framework->settings->baseUrl . "/platform/" . $framework->getSelectedPlatform());
            ?>
        </div>
        <div class="col-md-9">
            <div class="letter">
            <?php
            $documentation->printall();
            ?>
            </div>
            <p><img src="<?php echo Layout::getImagePath("BorderShadow.png", $settings)?>" /></p>
            <p></p>
        </div>
    </div>
</div>
</body>
</html>
