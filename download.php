<?php
$URL_KEY = 'url';
$NAME_KEY = 'name';
if((!isset($_POST[$URL_KEY])) || (!isset($_POST[$NAME_KEY]))) {
    die;
}


$url = filter_input(INPUT_POST, $URL_KEY);// 'http://yourdomain/actual/download?link=file.zip'; // build file URL, from your $_POST['file'] most likely
$name = filter_input(INPUT_POST, $name_KEY);
?>
<html>
<head>
    <!-- 5 seconds -->
    <meta http-equiv="Refresh" content="5; url=<?=$url?>" />
</head>
<body>
Thank you for downloading <?=$name?>
Download will start shortly.. or <a href="<?=$url?>">click here</a>
</body>
</html>