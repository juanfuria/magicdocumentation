<div class="row escape-navbar" id="<?=$json['id']?>">
    <div class="col-md-6 item-description">
        <h3><?=$json['name']?></h3>
        <?php if(isset($version)): ?>
            <!-- if there's a version we display it -->
            <span class="label label-primary">Available since <?=$json['version']?></span>
        <?php endif; ?>
        <?php if(isset($json['status'])): ?>
            <?php if($json['status'] == 'deprecated'): ?>
            <span class="label label-warning"><?=$json['status']?></span>
            <div class="callout callout-danger">
                <h4>Warning!</h4>

                <p>This method has been marked as deprecated. We strongly discourage you to use it.</p>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <p><?=$json['description']?></p>

        <?php if(isset($json['parameters']) &&  count($json['parameters']) > 0): ?>
            <h4>Parameters</h4>
            <table class="table-condensed table-responsive table-bordered">
                <thead>
                <tr class="active">
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Validation</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($json['parameters'] as $param): ?>
                <tr>
                    <td><?=$param['name']?></td>
                    <td><?=$param['type']?></td>
                    <td><?=$param['validation']?></td>
                    <td><?=$param['notes']?></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
        <?php foreach ($json['descriptionLists'] as $list): ?>
        <h4><?=$list['name']?></h4>
        <dl>
            <?php foreach ($list['elements'] as $elem): ?>
            <dt><?=$elem['name']?></dt>
            <dd><?=$elem['description']?></dd>
            <?php endforeach ?>
        </dl>
        <?php endforeach ?>
    </div>
    <div class="col-md-6 item-example">
        <?php if(isset($json['example']) &&  $json['example'] != ''): ?>
        <!--<h4>Code example</h4>-->
        <pre><code><?=$json['example']?></code></pre>
        <?php endif; ?>
    </div>
</div>