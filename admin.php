<?php
include_once('framework/php/Framework.php');


$framework = new Framework();
$framework->edit = true;

/** @var $settings Settings */
$settings = $framework->settings;


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<!--    <meta http-equiv="refresh" content="5; URL=">-->
    <?php
        $framework->printCssHeaders();

        $framework->printJavaScriptHeaders();

        $framework->printAjaxFunctions();
    ?>
    <title>Administration</title>
</head>
<body>
<!--<div class="container-fluid">-->
<!--    <div class="row-fluid">-->
<!--        <div class="col-sm-2 menu">-->
<!--            <ul class="list-group">-->
<!--                <li class="list-group-item active"><a href="javascript:editSettings();"><span class="glyphicon glyphicon-pencil">&nbsp;</span>Edit settings</a></li>-->
<!--                <li class="list-group-item active"><span class="glyphicon glyphicon-pencil">&nbsp;</span>Edit platforms</li>-->
<!--                --><?php
//                    foreach($framework->getListOfPlatforms() as $platform){
//                        echo '<li class="list-group-item list-group-subitem"><a href="javascript:editPlatform(\'' . $platform . '\');">' . $platform . '</a></li>';
//                    }
//                ?>
<!--<!--                <li class="list-group-item list-group-subitem"></li>-->-->
<!--                <li class="list-group-item active"><span class="glyphicon glyphicon-off">&nbsp;</span>Logout</li>-->
<!--            </ul>-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="col-sm-10 content" id="xcontent">-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<script>hljs.initHighlightingOnLoad();</script>
<?php
$framework->printNavBar();
?>
<div id="header-bar"></div>
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