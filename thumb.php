<?php
if((!isset ($_GET["file"])) || (!isset($_GET["size"])) || (!isset($_GET["ext"])))
    die;
//var_dump($_GET);
$mimeTypes = array(
    'pdf' => 'application/pdf',
    'txt' => 'text/plain',
    'html' => 'text/html',
    'exe' => 'application/octet-stream',
    'zip' => 'application/zip',
    'doc' => 'application/msword',
    'xls' => 'application/vnd.ms-excel',
    'ppt' => 'application/vnd.ms-powerpoint',
    'gif' => 'image/gif',
    'png' => 'image/png',
    'jpeg' => 'image/jpg',
    'jpg' => 'image/jpg',
    'php' => 'text/plain'
);

header('Content-Type: ' . $mimeTypes[$_GET["ext"]]);
@require_once('framework/inc/SimpleImage.php');
$image = new SimpleImage();
$image->load("img/" .$_GET["file"] . "." . $_GET["ext"]);//http://pickr.me/i/pickr_d672ccf8.jpg');
$image->resizeToWidth($_GET["size"]);
$image->output();

?>