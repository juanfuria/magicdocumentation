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

    echo $framework->getAjaxFunctions();
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
        .docs-nav {
            border-color: #a2a0a6;
            box-shadow: 0 1px 0 rgba(255,255,255,.1);
        }
        /*
        .docs-nav {
            text-shadow: 0 -1px 0 rgba(0,0,0,.15);
            background-color: #55bdae;
            border-color: #56545A;
            box-shadow: 0 1px 0 rgba(255,255,255,.1);
        }

        .docs-nav .navbar-collapse {
            border-color: #fff;
        }
        .navbar-brand{
            padding-right: 60px;
        }
        .navbar-brand:hover{
            color: #fff;
        }

        .docs-nav .navbar-brand {
            color: #fff;
        }
        .docs-nav .navbar-nav > li > a {
            color: #fff;
        }
        .docs-nav .navbar-nav > li > a:hover {
            color: #fff;
        }
        .docs-nav .navbar-nav > .active > a,
        .docs-nav .navbar-nav > .active > a:hover {
            color: #55bdae;
            background-color: #fff;
        }
        .docs-nav .navbar-toggle {
            border-color: #fff;
            border-width: 2px;
        }
        .docs-nav .navbar-toggle:hover {
            background-color: #fff;
            border-color:  #fff;
        }
        .docs-nav .navbar-toggle .icon-bar {
            background-color: #fff;
            border-color:  #fff;
        }
        */
        .docs-nav .container{
            padding: 0 15px 0 25px;
            margin-left: 0px;
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
