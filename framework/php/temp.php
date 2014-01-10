<?php

function surroundWithtag($tag, $string){
    return "<$tag>" . $string . "</$tag>";
}

$jsondata['name'] = "refund";
$jsondata['description'] = "A refund initiates a refund operation to the card reader. This operation moves funds from your account to the cardholders credit card. In it's simplest form you only have to pass the <strong>amount</strong> and <strong>currency</strong> but it also accepts a device object and a map with extra parameters.";

$param1["name"] = "amount";
$param1["type"] = "BigInteger";
$param1["validation"] = "Required";
$param1["notes"] = "Amount of funds to charge - in the minor unit of currency (f.ex. 1000 is 10.00 GBP)";

$jsondata['parameters'][0] = $param1;


$list1["name"] = "Events invoked";

$element["name"] = "currentTransactionStatus";
$element["description"] = "Invoked while during transaction with different statuses from card reader";

$list1["elements"][0] = $element;



$jsondata['descriptionLists'][0] = $list1;


$jsondata['example'] = '//Initiate a refund for 10.00 in Great British Pounds
        api.refund(new BigInteger("1000"),Currency.GBP)';

$string = json_encode($jsondata);


$result = '';

//echo "<pre>$string</pre><br /><br />";


$result .= surroundWithtag("h3", $jsondata["name"]);
$result .= surroundWithtag("p", $jsondata["description"]);

$parameters = $jsondata["parameters"];
if(count($parameters) > 0){

    $result .= surroundWithtag("h4", "Parameters");
    $result .= '<table class="table-condensed table-responsive table-bordered">
        <thead>
        <tr>
            <th>Parameter</th><th>Type</th><th>Validation</th><th>Notes</th>
        </tr>
        </thead>';


    foreach($parameters as $param){
        $td = '';
        $td .= surroundWithtag("td", $param["name"]);
        $td .= surroundWithtag("td", $param["type"]);
        $td .= surroundWithtag("td", $param["validation"]);
        $td .= surroundWithtag("td", $param["notes"]);

        $result .= surroundWithtag("tr", $td);
    }
    $result .= '
        </tbody>
    </table>';
}

$lists = $jsondata["descriptionLists"];
if(count($lists) > 0){

    foreach($lists as $list){
        $result .= surroundWithtag("h4", $list["name"]);
        $elements = '';
        foreach($list["elements"] as $element){
            $elements .= surroundWithtag("dt", $element["name"]);
            $elements .= surroundWithtag("dd", $element["description"]);
        }
        $result .= surroundWithtag("dl", $elements);
    }
}

if(isset($jsondata["example"])){
    $result .= surroundWithtag("h4", "Code examples");

    $example = '<code class="java">' . $jsondata["example"] . '</code>';
    $example .= surroundWithtag("pre", $example);

    $result .= $example;

}

include_once('Framework.php');

$m = new Method();

echo $m->toForm();


echo $result;

echo json_encode($jsondata);
?>



