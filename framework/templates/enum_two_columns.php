<div class="row escape-navbar" id="<?=$json['id']?>">
    <div class="col-sm-6 item-description">
        <h3 class="<?=$json['status']?>"><?=$json['title']?></h3>
        <?php if(isset($json['type'])): ?>
            <!-- if there's a version we display it -->
            <span class="label label-success"><?=$json['type']?></span>
        <?php endif; ?>
        <?php if(isset($json['version'])): ?>
            <!-- if there's a version we display it -->
            <span class="label label-primary">Available since <?=$json['version']?></span>
        <?php endif; ?>
        <?php if(isset($json['deprecated'])): ?>
                <span class="label label-danger">Deprecated since <?=$json['deprecated']?></span>
                <div class="callout callout-danger">
                    <h4>Warning!</h4>

                    <p>This enum has been marked as deprecated. We strongly discourage you to use it.</p>
                </div>
        <?php endif; ?>
        <br/>
        <br/>
        <p><?=$json['description']?></p>


        <?php if(isset($json['values']) &&  count($json['values']) > 0): ?>
            <h4>Possible values</h4>
            <div class="pills">
                <?php foreach ($json['values'] as $param): ?>
                    <code><?=$param?></code>
                <?php endforeach ?>
                </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-6 item-example">
        <?php if(isset($json['example']) &&  $json['example']['code'] != ''): ?>
            <h4>Code example</h4>
            <pre><code class="<?=$json['example']['language']?>"><?=$json['example']['code']?></code></pre>
        <?php endif; ?>
    </div>
</div>