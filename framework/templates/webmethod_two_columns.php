<div class="row escape-navbar" id="<?=$json['id']?>">
    <div class="col-sm-6 item-description">
        <h3>
            <?=$json['title']?>
            <?php if(isset($json['subtitle'])): ?>
                <!-- if there's a version we display it -->
                <small><?=$json['subtitle']?></small>
            <?php endif; ?>
        </h3>

        <?php if(isset($json['method'])): ?>
            <span class="label label-success <?=$json['method']?>"><?=$json['method']?></span>
        <?php endif; ?>

        <?php if(isset($json['version'])): ?>
            <!-- if there's a version we display it -->
            <span class="label label-primary">Available since <?=$json['version']?></span>
        <?php endif; ?>

        <?php if(isset($json['deprecated'])): ?>
            <span class="label label-danger">Deprecated since <?=$json['deprecated']?></span>
            <div class="callout callout-danger">
                <h4>Warning!</h4>

                <p>This method has been marked as deprecated. We strongly discourage you to use it.</p>
            </div>
        <?php endif; ?>

        <!-- REQUEST -->
        <?php if(isset($json['request'])){ ?>
            <div class="callout callout-info">
            <h3 class="underlined">Request</h3>
            <?php if(isset($json['path'])): ?><h4><small><?=$json['path']?></small></h4><?php endif; ?>
                <br/>
            <?php if(isset($json['request']['headers']) &&  count($json['request']['headers']) > 0){ ?>
                    <h4>Headers</h4>
                    <?php foreach ($json['request']['headers'] as $header): ?>
                       <code><?=$header?></code><br/>
                    <?php endforeach ?>
            <?php } ?>
                <br/>

            <?php if(isset($json['request']['parameters']) &&  count($json['request']['parameters']) > 0): ?>
                <h4>Parameters</h4>
                <table class="table-condensed table-responsive parameters">
                    <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Validation</th>
                        <th>Format</th>
                        <th>Notes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($json['request']['parameters'] as $param): ?>
                        <tr>
                            <td><code><?=$param['name']?></code></td>
                            <td><?=$param['validation']?></td>
                            <td class="center"><?=($param['format'] != '') ? $param['format']:"..."?></td>
                            <td><?=$param['notes']?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br />
                <br />
            <?php endif; ?>
                </div>
        <?php } ?>

        <!-- RESPONSE -->
        <?php if(isset($json['response'])){ ?>
        <div class="callout callout-warning">
            <h3 class="underlined">Response</h3>

            <?php if(isset($json['response']['codes']) &&  count($json['response']['codes']) > 0): ?>
                <h4>Response codes</h4>
                <table class="table-condensed table-responsive parameters">
                    <thead>
                    <tr>
                        <th>HTTP Code</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($json['response']['codes'] as $code): ?>
                        <tr>
                            <td><code><?=$code['code']?></code></td>
                            <td><?=$code['message']?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br />
                <br />
            <?php endif; ?>
            <br/>


            <?php if(isset($json['response']['parameters']) &&  count($json['response']['parameters']) > 0): ?>
                <h4>Parameters</h4>
                <table class="table-condensed table-responsive parameters">
                    <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Validation</th>
                        <th>Format</th>
                        <th>Notes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($json['request']['parameters'] as $param): ?>
                        <tr>
                            <td><code><?=$param['name']?></code></td>
                            <td><?=$param['validation']?></td>
                            <td class="center"><?=($param['format'] != '') ? $param['format']:"..."?></td>
                            <td><?=$param['notes']?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br />
                <br />
            <?php endif; ?>
            </div>
        <?php } ?>


        </div>
        <div class="col-sm-6 item-example">
            <?php if(isset($json['request']['example']) &&  count($json['request']['example']) > 0): ?>
                <h4 class="dl-title">Request example</h4>
                <?php if(isset($json['request']['example']['language'])): ?>
                    <pre><code class="<?=$json['request']['example']['language']?>"><?=$json['request']['example']['code']?></code></pre>
                <?php else: ?>
                    <pre><?=$json['request']['example']['code']?></pre>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(isset($json['response']['example']) &&  count($json['response']['example']) > 0): ?>
                <h4 class="dl-title">Response example</h4>
                <pre><code class="<?=$json['response']['example']['language']?>"><?=$json['response']['example']['code']?></code></pre>
            <?php endif; ?>
        </div>


</div>