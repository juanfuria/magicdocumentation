<?php

class Layout {


    static function printNavBar($navBarItems, $selectedItem, $baseUrl, $urlMode){
        echo '<div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SDK</a><span class="glyphicon glyphicon-tree-conifer"></span>
                    <ul class="nav navbar-nav">';
        foreach ($navBarItems as $platform) {
            $addon = '';
            if ($platform == $selectedItem) {
                $addon = ' class="active"';
            }

            $url = '';
            if($urlMode == UrlType::URL_VARS){
                $url = $baseUrl . 'index.php?platform=' . $platform . '';
            }
            else if ($urlMode == UrlType::URL_READABLE){
                $url = $baseUrl . 'platform/' . $platform . '/';
            }


            echo '<li' . $addon . '><a href="' . $url . '">' . $platform . '</a></li>';
        }

        /*
         <ul class="nav navbar-nav navbar-right">

    <li>
        <a href="../about"> … </a>
    </li>

</ul>
         * */

        echo '    </ul>
                </div>
            </div>
        </div>';
    }
    static function printMenu($menuItems){}
    static function printAllSections(){}
    static function printSection(){}
    static function printSectionItem(){}
} 