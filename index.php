<?php

include_once('framework/php/Framework.php');

$framework = new Framework();


if(!isset($framework->sentVars['project'])){
    include('cover.php');
}
else{


/** @var $settings Settings */
$settings = $framework->settings;

/** @var $documentation Documentation */
//$documentation = $framework->getDocumentation($framework->getSelectedPlatform());





?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="baseurl" id="baseurl" content="<?=$framework->settings->getBaseUrl()?>" />


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
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-sm-2 menu">
            <?php
            $framework->printMenu();
            ?>
        </div>
        <div class="col-sm-10 content">
            <div class="letter">
            <?php


            $framework->printSelectedPlatform();
            ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

}


