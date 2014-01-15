<?php

class Layout {

    static function printNavButtons($navBarItems, $selectedItem, $settings){
        foreach($navBarItems as $platform){
            echo '<a class="btn btn-success btn-lg ' . $platform .' platform-btn" href="';
            $url = '';
            if($settings->urlStyle == UrlType::URL_VARS){
                $url = $settings->getBaseUrl() . 'index.php?platform=' . $platform . '';
            }
            else if ($settings->urlStyle == UrlType::URL_READABLE){
                $url = $settings->getBaseUrl() . 'platform/' . $platform . '/';
            }
            //?platform='. $platform . '
            echo $url;
            echo '">';
            echo $platform;
            echo '</a>';
        }
    }

    static function printMenu($menuItems){}
    static function printAllSections(){}
    static function printSection(){}
    static function printSectionItem(){}

    /**
     * @param $imgName
     * @param $settings
     * @return string
     * @internal param \settings $ Settings
     */
    public static function getImagePath($imgName, $settings){
        return $settings->imgDir . "/" . $imgName;
    }

    public static function printMethod($json){
        $jsondata = json_decode($json, true);
        $result = '';

        $result .= '<div class="col-md-6 item-description">';
        $result .= Utils::surroundWithtag("h3", $jsondata["name"]);
        $result .= '<span class="label label-primary">Available since ' . $jsondata["version"] . '</span>';
        if(isset($jsondata["status"])){

            $result .= '
            <div class="callout callout-danger">
              <h4>Warning!</h4>
              <p>This method has been marked as deprecated. We strongly discourage you to use it.</p>
            </div>';
        }
        $result .= Utils::surroundWithtag("p", $jsondata["description"]);

        $parameters = $jsondata["parameters"];
        if(count($parameters) > 0){

        $result .= Utils::surroundWithtag("h4", "Parameters");
        $result .= '<table class="table-condensed table-responsive table-bordered">
                <thead>
                <tr class="active">
                    <th>Parameter</th><th>Type</th><th>Validation</th><th>Notes</th>
                </tr>
                </thead>';


        foreach($parameters as $param){
        $td = '';
        $td .= Utils::surroundWithtag("td", $param["name"]);
        $td .= Utils::surroundWithtag("td", $param["type"]);
        $td .= Utils::surroundWithtag("td", $param["validation"]);
        $td .= Utils::surroundWithtag("td", $param["notes"]);

        $result .= Utils::surroundWithtag("tr", $td);
        }
        $result .= '
                </tbody>
            </table>';
        }

        $lists = $jsondata["descriptionLists"];
        if(count($lists) > 0){

            foreach($lists as $list){
                $result .= Utils::surroundWithtag("h4", $list["name"]);
                $elements = '';
                foreach($list["elements"] as $element){
                    $elements .= Utils::surroundWithtag("dt", $element["name"]);
                    $elements .= Utils::surroundWithtag("dd", $element["description"]);
                }
                $result .= Utils::surroundWithtag("dl", $elements);
            }
        }
        $result .= '</div>';
        $result .= '<div class="col-md-6 item-example">';

        if(isset($jsondata["example"])){
            $result .= Utils::surroundWithtag("h4", "Code example");

            $example = '<code>' . $jsondata["example"] . '</code>';
            $result .= Utils::surroundWithtag("pre", $example);
        }

        $result .= '</div>';

        echo $result;
    }
} 