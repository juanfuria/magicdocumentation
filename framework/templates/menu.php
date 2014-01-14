<ul class="list-group">
    <?php foreach ($this->items as $item): ?>
        <li class="list-group-item <?=$item->class?>"><?=$item->badge?><a href="<?=$item->url?>"><?=$item->name?></a></li>
    <?php endforeach; ?>
</ul>