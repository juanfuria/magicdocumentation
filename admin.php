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
    <title>Administration</title>
</head>
<body>
<?php

echo $settings->toEdit();

?>
</body>
</html>