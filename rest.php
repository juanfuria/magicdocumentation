<?php

//Platform
//Section
//Method / Item
//http://alexmarandon.com/articles/web_widget_jquery/

include_once('framework/php/Framework.php');



/** @var $documentation Documentation */
//$documentation = $framework->getDocumentation($framework->getSelectedPlatform());

class API extends Rest
{

    private $framework;

    public function processApi()
    {
        $func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
        if((int)method_exists($this,$func) > 0){
            /** @var @framework Framework */
            $this->framework = new Framework();
            $this->$func();
        }
        else{
            $this->response('',404);
            // If the method not exist with in this class, response would be "Page not found".
        }
    }

    private function users()
    {
        //$result = array("Volvo","BMW","Toyota", array("uno", "dos", "tres"));
        $result['coches'] =  array("Volvo","BMW","Toyota");
        $result['username'] = 'mapache';
        $result['status'] = 'ok';
        $this->response(json_encode($result), 200);
    }

    private function platforms(){
        $this->response(json_encode($this->framework->getListOfPlatforms(), true), 200);
    }

    private function platform(){
        if(isset($this->framework->sentVars["name"])){
            $platform = $this->framework->sentVars["name"];
            $this->response(json_encode($this->framework->getDocumentation($platform), true), 200);

        }
        else{
            $this->response('',404);
            // If the method not exist with in this class, response would be "Page not found".
        }
    }

    private function section(){
        if($this->get_request_method() != "GET"){
            $this->response('',406,"");
        }
//set the xml nodes just in case xml is requested
        $this->pnode = 'waterpoints';
        $this->cnode = 'waterpoint';
        $id = (int)$this->_request['id'];//request for the sanitized waterpoint id
        $sql = "SELECT * FROM waterpoints WHERE waterpoint_id = '".$id."'";
        $this->getQueryData($sql);        //get query results

    }

    private function item(){

    }



}
$api = new API;
$api->processApi();