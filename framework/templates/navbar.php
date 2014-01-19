<header class="navbar navbar-default navbar-fixed-top docs-nav" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><span class="glyphicon glyphicon-cloud"></span>&nbsp;<?=$title?></a>
        </div>
        <nav class="collapse navbar-collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <?php foreach ($this->items as $item): ?>
                    <li <?=$item->class?>><a href="<?=$item->url?>"><?=$item->platform?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>