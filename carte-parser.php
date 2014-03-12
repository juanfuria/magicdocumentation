
<?php


include_once('framework/php/Framework.php');

$framework = new Framework();

/** @var $settings Settings */
$settings = $framework->settings;

function processParam($string){
    $string = substr($string, 4);
    $parts = explode("** ", $string);
    $key = str_ireplace("`", "", $parts[0]);
    $key = str_ireplace(":", "", $key);
    $data = trim($parts[1]);
    $res['name'] = $key;
    $res['type'] = "String";
    $res['validation'] = "Required";
    $res['notes'] = $data;

    return $res;
}

$files = Utils::listFiles("carte_files", "md");

foreach($files as $path){
    $fileinfo = pathinfo($path);


    echo "<pre>" . print_r($fileinfo, true) . "</pre>";

    $file = file($fileinfo['dirname'] . '/' . $fileinfo['basename'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


    $HEADER = 0;
    $DESCRIPTION = 1;
    $REQUEST = 2;
    $REQUEST_PARAMS = 3;
    $REQUEST_EXAMPLE = 4;
    $RESPONSE = 5;
    $RESPONSE_PARAMS = 6;
    $RESPONSE_CODES = 7;
    $RESPONSE_EXAMPLE = 8;


    $header_tags = 0;;
    $status = $HEADER;

    $res = [];

    $header_fields[] = "category";
    $header_fields[] = "path";
    $header_fields[] = "title";
    $header_fields[] = "type";
    $header_fields[] = "layout";

    $requestMode = false;

    for($x = 0; $x < count($file) ; $x++){

        $line = $file[$x];
    //    echo "<br>Line: $x <br>";

        switch($status){
            case $HEADER:
                if($line == "---"){

                    if(++$header_tags == 2){
                        $status = $DESCRIPTION;
                    }
                }
                else{
                    $found = false;
                    $count = 0;
                    while(($found == false) && ($count < count($header_fields))){
                        $pos = strpos($line, $header_fields[$count]);
                        if($pos !== false){
                            $found = true;
                            $fields = explode(":", $line, 2);
                            if(count($fields) == 2){
                                $data = $fields[1];
                                $data = str_ireplace("'", "", $data);
                                $data = trim($data);
                                $res[$fields[0]] = $data;
                            }
                        }
                        $count++;
                    }
                }

                break;
            case $DESCRIPTION:
                if(trim($line) == "###Request"){
                    $status = $REQUEST;
                }
                else{
                    $res['description'] .= $line;
                }

                break;
            case $REQUEST:
                if(trim($line) == "####Parameters"){
                    $status = $REQUEST_PARAMS;
                }
                elseif(trim($line) == "####Example"){
                    $status = $REQUEST_EXAMPLE;
                }
                break;
            case $REQUEST_PARAMS:
                if(Utils::startsWith($line, "* **")){
                    $res['request']['parameters'][] = processParam($line);
                }
                elseif(Utils::startsWith($line,"####Example")){
                    $status = $REQUEST_EXAMPLE;
                }
                elseif(Utils::startsWith($line,"###Response")){
                    $status = $RESPONSE;
                }

                break;
            case $REQUEST_EXAMPLE:
                if(Utils::startsWith($line,"###Response")){
                    $status = $RESPONSE;
                }
                else{
                    $res['request']['example'][] = $line;
                }
                break;
            case $RESPONSE:
                if(trim($line) == "####Parameters"){
                    $status = $RESPONSE_PARAMS;
                }
                elseif(trim($line) == "####Response Codes"){
                    $status = $RESPONSE_CODES;
                }
                elseif(trim($line) == "####Example"){
                    $status = $RESPONSE_EXAMPLE;
                }
                break;
            case $RESPONSE_PARAMS:
                if(Utils::startsWith($line, "* **")){
                    $res['response']['parameters'][] = processParam($line);
                }
                elseif(Utils::startsWith($line,"####Response Codes")){
                    $status = $RESPONSE_CODES;
                }
                elseif(Utils::startsWith($line,"####Example")){
                    $status = $RESPONSE_EXAMPLE;
                }
                break;
            case $RESPONSE_CODES:
                if(Utils::startsWith($line,"|")){
                    if((Utils::startsWith($line, "| HTTP Status Code | Description |") != true) && (Utils::startsWith($line, "| ------------- |:-------------:|") != true)){
                        $line = substr($line, 1);
                        $line = substr($line, 0, strlen($line) -1);
                        $parts = explode("|", $line);
                        $code['code'] = trim($parts[0]);
                        $code['message'] = trim($parts[1]);
                        $res['response']['codes'][] = $code;
                    }
                }
                elseif(Utils::startsWith($line,"####Example")){
                    $status = $RESPONSE_EXAMPLE;
                }
                break;
            case $RESPONSE_EXAMPLE:
                $res['response']['example'] .= str_ireplace("```", "", str_ireplace("    ", "\t", $line)) . "\n";
                break;
        }
    }

    echo "<pre>" . json_encode($res,JSON_PRETTY_PRINT) . "</pre>";
}