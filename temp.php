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
        .center{
            text-align: center;
        }
        .center *{
            margin: auto;
        }
        #hi{
            margin: 40px; 0;
        }
        #form{
            width: 330px;
            border-radius: 6px;
            min-height: 430px;
            background-color: #535353;
            color: #cacaca;
        }
        #sign-in{
            padding: 20px 0;
        }
        .form-control{
            width: 95%;
        }
    </style>
</head>
<body>
<div class="center">
    <div id="hi" class="center"><img src="<?=$settings->getBaseUrl() . "thumb/Hi_150.png"; ?>" /></div>
    <div id="form">
        <form>
            <input type="text" class="form-control" placeholder="Email"/>
            <input type="text" class="form-control" placeholder="Password"/>
            <input type="text" class="form-control" placeholder="Confirm password"/>
            <input type="submit" class="form-control btn btn-default btn-block" placeholder="Create your Handpoint account"/>
        </form>
    </div>
    <div id="sign-in">Already have an account? <a>Sign in.</a></div>
    <div id="footer"></div>
</div>

</body>
</html>
