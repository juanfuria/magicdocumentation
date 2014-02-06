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
        echo $framework->printCssHeaders();

        echo $framework->printJavaScriptHeaders();

        ?>
        <title><?php echo $settings->pageTitle; ?></title>
        <style>
            body{
                background: url(<?=Layout::getImagePath("blur.jpg", $settings)?>) center center fixed no-repeat !important;
                background-size: auto;
            }
            .jumbotron{
                margin-top: 220px;
                margin-bottom:-10px;
            }
            .platform-btn{
                margin-right: 25px;
            }
            .slogan{
                font-size: 50px;
                font-weight: 100;
                letter-spacing: 3px;
                /*color:#514736;*/
                color:#fff;

            }
            .banner{
                margin: 30px 0px;
            }
            .box{
                background: rgba(255, 255, 255, 0.25);
                width: 70%;
                margin: auto;
                margin-bottom:10px;
                color:#fff;
                font-weight: 100;
                /*font-size: 200%;*/
                padding: 10px 20px;
                letter-spacing: 2px;
            }
        </style>
    </head>
    <body>
    <div class="center banner">
<!--        <img src="--><?//=$settings->getBaseUrl() . "thumb/dev-logo-ball_120.png"; ?><!--" /><br />-->
        <img src="<?=Layout::getImagePath("dev-logo-ball.png", $settings)?>" />


    </div>
    <div class="box">
        <div class="slogan center">handpoint[dev]</div>
    </div>
    <div class="box">

        handpoint[dev] is the perfect place to be if you're looking on how to integrate with our products.

        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
        Here have some content
        <br/>
    </div>
    <div class="box">
        handpoint[dev] is part of <a href="http://handpoint.com"><img src="<?=$settings->getBaseUrl() . "thumb/handpoint-logo-w_100.png"; ?>" /></a>
    </div>
<!--    -->
<!--        <div class="jumbotron">-->
<!--            <div class="container">-->
<!--                <span class="ball ball-box"></span><h1>--><?php //echo $settings->pageTitle; ?><!--</h1>-->
<!--                <p>-->
<!--                    --><?php
//                    $filename = "Introduction.html";
//                    $path = $settings->filesDir . "/" . $filename;
//                    if(file_exists($path)){
//                        $file = new File($path);
//                        echo $file->getContent();
//                    }
//                    ?>
<!--                </p>-->
<!--                <p><a class="btn btn-primary btn-lg" role="button" href="index.php">Learn more &raquo;</a></p>-->
<!--                <br />-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="jumbotron">-->
<!--            <div class="container ">-->
<!--                <h1><span><img src="--><?php //echo Layout::getImagePath("open-box.png", $settings); ?><!--" /> </span>Available platforms</h1>-->
<!--                <div style="text-align:center !important;">-->
<!--                    --><?php
//                    $framework->printNavButtons();
//                    ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </body>
</html>
