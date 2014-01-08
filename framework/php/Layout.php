<?php

class Layout {


    static function printNavBar($navBarItems, $selectedItem, $settings){
        echo '
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">



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
            if($settings->urlMode == UrlType::URL_VARS){
                $url = $settings->baseUrl . Utils::getStringAfterLast($_SERVER["PHP_SELF"], "/") . '?platform=' . $platform . '';
            }
            else if ($settings->urlMode == UrlType::URL_READABLE){
                $url = $settings->baseUrl . 'platform/' . $platform . '/';
            }


            echo '<li' . $addon . '><a href="' . $url . '">' . $platform . '</a></li>';

        }

        echo '    </ul>
        </nav>';
    }

    static function printNavButtons($navBarItems, $selectedItem, $settings){
        foreach($navBarItems as $platform){
            echo '<a class="btn btn-success btn-lg ' . $platform .' platform-btn" href="';
            $url = '';
            if($settings->urlMode == UrlType::URL_VARS){
                $url = $settings->baseUrl . 'view.php?platform=' . $platform . '';
            }
            else if ($settings->urlMode == UrlType::URL_READABLE){
                $url = $settings->baseUrl . 'platform/' . $platform . '/';
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
} 