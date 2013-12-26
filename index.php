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

<?php
    $framework->printNavBar();
?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-2">
                    <ul class="list-group">
                        <?php 
                        $documentation->printMenu($framework->settings->baseUrl . "/platform/" . $framework->getSelectedPlatform());
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
