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
                font-size: 29px;
                font-weight: 100;
                letter-spacing: 3px;
                color:#514736;
                color: #fff;
                line-height: 1.6;
            }
            .banner{
                margin: 30px 0px;
            }
            .box{
                background: rgba(255, 255, 255, 0.25);
                width: 70%;
                margin: auto;
                margin-bottom: -1px;
                background-color: #F5F5F5;
                padding: 10px 20px;
                color: #8A8A8A;
                border: 1px solid #B8B8B8;
            }
            .box .btn{

                color:#514736;
                font-weight: 500;
            }
            .header{
                background: #535353;
                color: #fff;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                border-color: #535353;
            }
            .footer{
                background: #535353;
                color: #fff;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
                border-color: #535353;
                font-weight: 100;
                letter-spacing: 1px;
            }
            .footer a, .header a{
                color: #fff;
            }

            .sect{
                padding: 10px;
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div class="center banner">
        <img src="<?=$settings->getBaseUrl() . "thumb/dev-logo-ball_120.png"; ?>" /><br />
<!--        <img src="--><?//=Layout::getImagePath("dev-logo-ball.png", $settings)?><!--" />-->


    </div>
    <div class="box header">
        <img src="<?=$settings->getBaseUrl() . "thumb/handpoint-logo-w_160.png"; ?>" />[dev]
<!--        <span class="handpoint-logo slogan"></span>[dev]-->
        <span style="float:right;">
            <a href="#" class="btn btn-default">Sign up</a>
            <a href="#" class="btn btn-default">Order a demo kit</a>
        </span>
    </div>
    <div class="box">
        <div class="container">
            <div class="row">
                <div class="col-md-6 device sect">
                    <h1>Use a card reader</h1>
                    <br /><br /><br />

                    <span class="handpoint-mpos" style="font-size: 250px;"></span>
                    <br /><br /><br />

                    <?php $framework->printNavButtons();  ?>
                </div>
                <div class="col-md-6 ecommerce sect">
                    <h1>Use the cloud</h1>
                    <br /><br /><br />

                    <span class="handpoint-laptops" style="font-size: 250px;"></span>
                    <br /><br /><br />

                    <?php $framework->printNavButtons();  ?>
                </div>
            </div>
        </div>


    </div>
    <div class="box footer">
        <a href="https://handpoint.com">handpoint.com</a> // sales@handpoint.com // Tel: +3545103300 // @HandpointLtd
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
