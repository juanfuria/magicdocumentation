<?php
$URL_KEY = 'url';
$NAME_KEY = 'name';
if((!isset($_POST[$URL_KEY])) || (!isset($_POST[$NAME_KEY]))) {
    die;
}


$url = filter_input(INPUT_POST, $URL_KEY);
$name = filter_input(INPUT_POST, $name_KEY);

//$name = 'hapi-3.0.0.tbz2';
?>
<html>
<head>
    <!-- 5 seconds -->
    <meta http-equiv="Refresh" content="2; url=<?=$url?>" />
    <link rel="stylesheet" href="framework/css/handpoint-font.css">
    <link rel="stylesheet" href="framework/css/ballicons.min.css">
    <style>
        *
        {
            margin:0;padding:0;
        }

        html,body
        {
            height:100%;
        }
        body
        {
            background: #55bdae;
            font-family:'Helvetica Neue', Helvetica, Avenir, HelveticaNeue, Arial, sans-serif;
        }

        .container
        {
            line-height: 2em;
            font-size: 20px;
            font-weight: 300;
            letter-spacing: .02em;
            width:50%;
            background-color: #e9e9e9;
            background-repeat: no-repeat;
            background-position: 60px center;
            padding: 50px 50px 50px 250px;
            margin-top: 20px;
            display: table-cell;
            vertical-align: middle;
        }
        .huge{
            font-size: 180px;
            padding: 60px;
        }
        .big{
            font-size: 80px;
            padding: 40px;
        }
        .center{
            text-align: center;
        }
        .white{
            color:#FFF;
        }
        a{
            color:#55bdae;;
        }
    </style>
</head>
<body>
    <div class="center big white"><span class="handpoint-logo"></span></div>
    <div class="ball ball-open-box container">
        <p>Your download should start automatically in a few seconds, but if it doesn't, please <strong><a href="<?=$url?>">click here</a></strong></p>
        <div>Thank you for downloading <strong><?=$name?></strong></div>
    </div>
    <div class="huge center white"><span class="handpoint-smile"></span></div>

</body>
</html>