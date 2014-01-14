<div class="row escape-navbar" id="elem_cancel_transaction">
    <div class="col-md-6 item-description"><h3>cancelRequest</h3><span>(Available since version:    1.0.0)</span>

        <div class="callout callout-danger">
            <h4>Warning!</h4>

            <p>This method has been marked as deprecated. We strongly discourage you to use it.</p>
        </div>
        <p>This method attempts to cancel the current operation on device. Note that operations cannot be cancelled at
            certain points in the transaction process</p><h4>Parameters</h4>
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
            <tr>
                <td>device</td>
                <td>Device</td>
                <td>Optional</td>
                <td>This is used if you want to send the operation to a specific device. Recommended if you are using
                    multiple devices
                </td>
            </tr>
            </tbody>
        </table>
        <h4>Events invoked</h4>
        <dl>
            <dt>currentTransactionStatus</dt>
            <dd>Invoked while during transaction with different statuses from card reader</dd>
            <dt>endOfTransaction</dt>
            <dd>Invoked when the card reader finishes processing the transaction</dd>
        </dl>
        <h4>Returns</h4>
        <dl>
            <dt>Boolean</dt>
            <dd>true if the operation was successfully sent to device</dd>
        </dl>
    </div>
    <div class="col-md-6 item-example"><h4>Code example</h4><pre><code class="java hljs "><span class="hljs-comment">//Attempts to cancel an operation</span>
                api.cancelRequest();</code></pre>
    </div>
</div>