<?php
include_once('framework/php/Framework.php');

/** @var  $framework Framework*/
$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;


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
                <!-- background: url(<?=Layout::getImagePath("blur.jpg", $settings)?>)  fixed  !important; -->
            }
            .jumbotron{
                margin: 0;
            }

            .jumbotron .title{
                font-size: 60px;
                line-height: 1;
                margin-bottom: 20px;
            }
            .platform-btn{
                margin-right: 25px;
            }
            .slogan{

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

            .space-down{
                margin-bottom: 70px;
            }

            .hi{
                width: 100%;
                margin: 20px 0;
            }

            .center{
                text-align: center;
            }
            .buttons{
                padding: 10px;
                text-align:right;
            }

            .palette-wet-asphalt{
                background-color: #535353;
                color: #cacaca;
            }

            .palette-wet-asphalt .btn-default{
                color: #535353;
                font-weight: bold;
            }

            .palette-emerald{
                background-color: #1abc9c;
                color: #fff;
            }


            .palette-emerald .btn-default{
                background-color: #fff;
                color: #535353;
                font-weight: bold;
            }


            .arrow {
                position: relative;
                background-color:#535353;
                margin: 0;
                -webkit-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
                -moz-box-shadow: 0px 0 3px rgba(0,0,0,0.25);
                box-shadow: 0px 0 3px rgba(0,0,0,0.25);
            }
            .arrow:after {
                position: absolute;
                display: block;
                content: "";
                border-color: #fff transparent transparent transparent;
                border-style: solid;
                border-width: 30px;
                height:0;
                width:0;
                position:absolute;
                bottom:-59px;
                left:12em;
            }

            .arrow-white:after{
                border-color: #fff transparent transparent transparent;
            }
            .arrow-wet-asphalt:after{
                border-color: #535353 transparent transparent transparent;
                left: 82%;
            }

            .handpoint-key-ok{
                color: #1abc9c;
                font-size: 300px;
                z-index: 100;
            }
            .glyphicon-cloud{

                font-size: 220px;
                text-shadow: 4px 6px #ecf0f1;
            }

            .fix{

                width: 135px;
                height: 100px;
                float: left;
                margin-top: -200px;
                margin-left: 51px;
                background: #fff;
            }

            .align-right{
                padding-right: 40px;
            }
            .align-left{
                padding-left: 40px;
            }
            .align-right{
                text-align: right;
            }
            .align-left{
                text-align: left;
            }


        </style>
    </head>
    <body>
        <div class="buttons">
            <a href="#" class="btn btn-success">Sign up</a>
            <a href="#" class="btn btn-warning">Order a demo kit</a>
        </div>
<!--    <img src="<?=$settings->getBaseUrl() . "thumb/dev-logo-ball_120.png"; ?>" />-->
        <div>
            <div class="hi center"><img src="<?=$settings->getBaseUrl() . "thumb/Hi_200.png"; ?>" /></div>
            <div class="center lead space-down"><h1>Welcome developers</h1></div>
            <div class="palette-wet-asphalt center"><div class="arrow arrow-white palette-wet-asphalt"></div></div>
        </div>


        <div class="jumbotron palette-wet-asphalt">
            <div class="row">
                <div class="col-sm-9 align-right">
                    <div class="title">Pay with our card reader</div>
                    <div class="">Get access to the tutorials, libraries and full documentation<br />that will enable you to integrate with our card reader.
                        <br /><strong>easy-peasy</strong>
                        <br /><br />
                        <p><a href="#" class="btn btn-default btn-lg">Give me the docs!</a></p>
                    </div>
                </div>
                <div class="col-sm-2"><span class="handpoint-key-ok"></span><span class="fix"></span></div>
                <div class="clearfix visible-xs"></div>
            </div>
        </div>

        <div class="palette-emerald center"><div class="arrow arrow-wet-asphalt palette-emerald"></div></div>

        <div class="jumbotron palette-emerald">
            <div class="row">
                <div class="col-sm-3 center"><span class="glyphicon glyphicon-cloud"></span></div>
                <div class="col-sm-8 align-left">
                    <div class="title">...or with our cloud gateway</div>
                    <div class="">Use our powerful cloud gateway for your e-commerce solution

                        <br /><br />
                        <p><a href="#" class="btn btn-default btn-lg">Take me to the clouds!</a></p></div>
                </div>
                <div class="clearfix visible-xs"></div>
            </div>
        </div>


    </body>
</html>
