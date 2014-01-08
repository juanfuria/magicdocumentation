<?php
include_once('framework/php/Framework.php');


$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        echo $framework->getFormattedCSSList();

        echo $framework->getFormattedJavaScriptList();

        ?>
        <title><?php echo $settings->pageTitle; ?></title>
        <style>
            body{
                background: url(<?php echo Layout::getImagePath($settings, "mpos-green-bg.jpg"); ?>) center -305px fixed no-repeat !important;
                background-size: auto;
            }
            .jumbotron{
                margin-top: 220px;
                margin-bottom:-10px;
            }
            .platform-btn{
                margin-right: 25px;
            }
        </style>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <h1><span><img src="<?php echo Layout::getImagePath($settings, "box.png"); ?>" /> </span><?php echo $settings->pageTitle; ?></h1>
                <p>
                    <?php
                    $filename = "Introduction.html";
                    $path = $settings->filesDir . "/" . $filename;
                    if(file_exists($path)){
                        $file = new File($path);
                        echo $file->getContent();
                    }
                    ?>
                </p>
                <p><a class="btn btn-primary btn-lg" role="button" href="platformViewer.php">Learn more &raquo;</a></p>
            </div>
        </div>

        <div class="jumbotron">
            <div class="container ">
                <h1><span><img src="<?php echo Layout::getImagePath($settings, "open-box.png"); ?>" /> </span>Available platforms</h1>
                <div style="text-align:center !important;">
                    <?php
                    foreach($framework->platforms as $platform){
                        echo '<a class="btn btn-success btn-lg ' . $platform .' platform-btn" href="platformViewer.php?platform='. $platform . '">';
                        echo $platform;
                        echo '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
