<div class="row escape-navbar" id="<?=$json['id']?>">
    <div class="col-md-6 item-description">
        <h3 class="<?=$json['status']?>"><?=$json['title']?></h3>
        <?php if(isset($json['type'])): ?>
            <!-- if there's a version we display it -->
            <span class="label label-success"><?=$json['type']?></span>
        <?php endif; ?>
        <?php if(isset($json['version'])): ?>
            <!-- if there's a version we display it -->
            <span class="label label-primary">Available since <?=$json['version']?></span>
        <?php endif; ?>
        <?php if(isset($json['status'])): ?>
            <?php if($json['status'] == 'deprecated'): ?>
            <span class="label label-danger"><?=$json['status']?></span>
            <div class="callout callout-danger">
                <h4>Warning!</h4>

                <p>This method has been marked as deprecated. We strongly discourage you to use it.</p>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <br/>
        <br/>
        <p><?=$json['description']?></p>

        <?php if(isset($json['parameters']) &&  count($json['parameters']) > 0): ?>
            <h4>Parameters</h4>
            <table class="table-condensed table-responsive parameters">
                <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Type</th>
                    <th>Validation</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($json['parameters'] as $param): ?>
                <tr>
                    <td><code><?=$param['name']?></code></td>
                    <?php if(in_array(Utils::camelCase($param['type']), $entities)){?>
                        <td><em><a href="#elem_<?=Utils::camelCase($param['type'])?>"><?=$param['type']?></a></em></td>
                    <?php }else{ ?>
                        <td><em><?=$param['type']?></em></td>
                    <?php } ?>
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
            <!-- TODO limit to existing entities -->
            <?php foreach ($list['elements'] as $elem): ?>
                <?php if(in_array($elem['name'], $entities)){?>
                    <dt class="underlined"><a href="#elem_<?=$elem['name']?>"><?=$elem['name']?> <span class="glyphicon glyphicon-chevron-down"></span></a></dt>
                <?php }else{ ?>
                    <dt class="underlined"><?=$elem['name']?></dt>
                <?php } ?>
            <dd><?=$elem['description']?></dd>
            <?php endforeach ?>
        </dl>
        <?php endforeach ?>
    </div>
    <div class="col-md-6 item-example">
        <?php if(isset($json['example']) &&  $json['example'] != ''): ?>
        <h4>Code example</h4>
        <pre><code><?=$json['example']?></code></pre>
        <?php endif; ?>
    </div>
</div>