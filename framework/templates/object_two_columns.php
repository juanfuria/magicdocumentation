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

                    <p>This object has been marked as deprecated. We strongly discourage you to use it.</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <br/>
        <br/>
        <p><?=$json['description']?></p>




        <?php if(isset($json['methods']) &&  count($json['methods']) > 0): ?>
            <h4>Methods</h4>

                <?php foreach ($json['methods'] as $method): ?>
                <div class="callout callout-info">
                    <h4><?=$method['title']?></h4>
                    <p><?=$method['name']?>(

                    <?php if(isset($method['parameters']) &&  count($method['parameters']) > 0): ?>
                        <?php foreach ($method['parameters'] as $key => $param): ?>
                            <?=$param['type']?> <?=$param['name']?>
                            <?php if($key < count($method['parameters'])-1){ ?>
                                ,
                            <?php } ?>
                        <?php endforeach ?>
                    );</p>
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
                        <?php foreach ($method['parameters'] as $param): ?>
                            <tr>
                                <td><code><?=$param['name']?></code></td>

                                <?php if(in_array(Utils::camelCase($param['type']), $entities)){?>
                                    <td><em><a href="#elem_<?=Utils::camelCase($param['type'])?>"><?=$param['type']?></a></em></td>
                                <?php }else{ ?>
                                    <td><em><?=$param['type']?></em></td>
                                <?php } ?>

<!--                                    <td><em>--><?//=$param['type']?><!--</em></td>-->
                                <td><?=$param['validation']?></td>
                                <td><?=$param['notes']?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php endif; ?>

                </div>
                <?php endforeach ?>
        <?php endif; ?>

        <?php if(isset($json['properties']) &&  count($json['properties']) > 0): ?>
            <h4>Properties</h4>
            <table class="table-condensed table-responsive parameters">
                <thead>
                <tr>
                    <th>Property</th>
                    <th>Type</th>
                    <th>Accessor</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($json['properties'] as $param): ?>
                    <tr>
                        <td><code><?=$param['name']?></code></td>
                        <?php if(in_array($param['name'], $entities)){?>
                            <td><em><a href="#elem_<?=$param['type']?>"><?=$param['type']?></a></em></td>
                        <?php }else{ ?>
                            <td><em><?=$param['type']?></em></td>
                        <?php } ?>
                        <td><?=$param['accessorType']?></td>
                        <td><?=$param['description']?></td>
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
                        <dt class="underlined"><a href="#elem_<?=$elem['type']?>"><?=$elem['type']?> <span class="glyphicon glyphicon-chevron-down"></span></a></dt>
                    <?php }else{ ?>
                        <dt class="underlined"><?=$elem['type']?></dt>
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