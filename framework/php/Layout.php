<?php

class Layout {


    static function printNavBar($navBarItems, $selectedItem, $baseUrl, $urlMode, $settings){
        echo '
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">



                <div class="navbar-header">
                    <a class="navbar-brand" href="#">'.$settings->pageTitle.'</a>

                </div>
                    <ul class="nav navbar-nav">';
        foreach ($navBarItems as $platform) {
            $addon = '';
            if ($platform == $selectedItem) {
                $addon = ' class="active"';
            }

            $url = '';
            if($urlMode == UrlType::URL_VARS){
                $url = $baseUrl . Utils::getStringAfterLast($_SERVER["PHP_SELF"], "/") . '?platform=' . $platform . '';
            }
            else if ($urlMode == UrlType::URL_READABLE){
                $url = $baseUrl . 'platform/' . $platform . '/';
            }


            echo '<li' . $addon . '><a href="' . $url . '">' . $platform . '</a></li>';

        }

        echo '    </ul>
        </nav>';
    }
    static function printMenu($menuItems){}
    static function printAllSections(){}
    static function printSection(){}
    static function printSectionItem(){}

    /** @var settings Settings */
    public static function getImagePath($settings, $imgName){
        return $settings->imgDir . "/" . $imgName;
    }
} 