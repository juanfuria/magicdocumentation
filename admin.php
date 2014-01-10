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

        echo $framework->getAjaxFunctions();
    ?>
    <title>Administration</title>
</head>
<body>
<div class="container">
<?php

echo $settings->toForm();

$file = new File("files/Android/Transactions/Refund.html");
$json = $file->getContent();

echo Layout::printMethod($json);
?>
</div>
</body>
</html>