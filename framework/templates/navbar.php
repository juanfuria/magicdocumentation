<header class="navbar navbar-default navbar-fixed-top docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://www.handpoint.com/mpos/"><div id="logo"></div></a>
        </div>
        <nav class="collapse navbar-collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav" id="xnavbar">
                <?php foreach ($items as $item): ?>
                    <li <?=$item->class?>><a id="xplatform_<?=Utils::camelCase($item->platform)?>" href="<?=$item->url?>"><?=$item->platform?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

    <div id="buttons">
       <a class="btn btn-default" href="https://www.handpoint.com/?MPOS#sign-up">Sign up</a>
       <a class="btn btn-default " href="https://www.handpoint.com/mpos/#signup">Order a starter kit</a>

    </div>
</header>