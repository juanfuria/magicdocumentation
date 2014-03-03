<?php

class Project extends Entity
{

    public $platforms = array();
    public $name;
    public $description;
    public $framework;


    public function getListOfPlatforms()
    {

        $platforms = array();

        foreach ($this->platforms as $platform) {
            $platforms[count($platforms)] = $platform->name;
        }
        return $platforms;
    }

    function getPlatform($platform_name){
        return $this->platforms[$platform_name];
    }


    public function getSelectedPlatformName(){
        $frw = $this->framework;
        return (isset($frw->sentVars["platform"])) ? $frw->sentVars["platform"] : $this->getListOfPlatforms()[0];
    }
    public function getSelectedPlatform(){
        return $this->platforms[$this->getSelectedPlatformName()];
    }

    function printAll($platform){

        if(count($platform->versions) > 0){
            $viewing = (isset($this->framework->sentVars['version'])) ? $this->framework->sentVars['version'] : $platform->versions[0];
            echo '<div class="version-info">
                        <span class="alert alert-info">You are currently viewing the documentation for version
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            ' . $viewing . ' <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">';
                    foreach($platform->versions as $version){
                        $url = '#';
                        if($this->framework->settings->urlStyle == UrlType::URL_VARS){
                            $url = $this->framework->settings->getBaseUrl() . Utils::getStringAfterLast($_SERVER["PHP_SELF"], "/") . '?project=' . $this->name . '&platform=' . $platform->name . '&version=' . $version;
                        }
                        else if ($this->framework->settings->urlStyle == UrlType::URL_READABLE){
                            $url = $this->framework->settings->getBaseUrl() . $this->name . '/' . $platform->name . '/' . $version . '/';
                        }
                        echo '<li><a href="' . $url . '">' . $version . '</a></li>';
                    }

              echo '        </ul>
                        </div>
                    </span>
                </div>';
        }

        /** @var $section Section */
        foreach ($platform->sections as $section) {
            $this->printSectionContent($platform->name, $section);
        }

    }

    function printSectionContent($platform_name, $section){

        $content = '<section id="section_' . Utils::camelCase($section->name) . '" class="escape-navbar">';
        $content.= '<div class="row" >
        <div class="col-sm-6 item-description">
        <h2>' . $section->name . '</h2></div>';

        //TODO fix horrible kludge
        if(!$section->special){
            $content.= '<div class="col-sm-6 item-example"></div>';
        }
        $content.= "</div>";


        if(isset($this->framework->sentVars['version'])){
            $version = $this->framework->sentVars['version'];
        }
        $count = 0;

        /** @var $file File */
        foreach ($section->files as $file){

            //TODO: if json has more than one...
            $isJson = ($file->ext == 'json');


            //HTML
            if(!$isJson){

                $view = new Template($this->framework->settings->getTemplatesDir() . "/section_item.php");
                $view->elemName = $file->name;
                $view->content  = $file->content;
                $content .= $view;
                $count++;

            }
            //JSON
            else{

                $printable = null;
                if(isset($version)){
                    $printable = Utils::getElemFromJson($version, $file->json);
                }
                else{
                    if(Utils::itemNotDeprecated($this->getSelectedPlatform()->versions[0], $file->json[0])){
                        $printable =  $file->json[0];
                    }
                }

                if($printable != null){
                    $template_name      = $this->framework->settings->getTemplate($printable['type']);
                    $subview            = new Template($this->framework->settings->getTemplatesDir() . "/" . $template_name . ".php");
                    $subview->entities  = $this->getPlatform($platform_name)->entities;
                    $subview->json      = $printable;

                    $view               = new Template($this->framework->settings->getTemplatesDir() . "/section_item.php");
                    $view->elemName     = $printable['name'];
                    $view->content      .= $subview;

                    $content .= $view;

                    $count++;
                }
            }

        }

        $content.= '</section>';

        if($count > 0){
            echo $content;
        }
    }

}