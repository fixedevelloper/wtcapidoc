@extends('base')

@section('content')

    <h3 class="page-title">Post transfer mobil</h3>
    <h4 class="page-title">URL: <span class="text-success">api/wtc_transactions/mobil</span></h4>
    <div class="row">
        <div class="col-md-7">
            <!-- TABLE HOVER -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Request</h3>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Position</th>
                            <th>#</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>wtc-key</td>
                            <td><code>string</code></td>
                            <td><code>Header</code></td>
                            <td><code>Required</code></td>
                            <td>Authentification key. Generate by the system. </td>
                        </tr>
                        <tr>
                            <td>sender_id</td>
                            <td><code>integer</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>ID sender </td>
                        </tr>
                        <tr>
                            <td>beneficiary_id</td>
                            <td><code>integer</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>ID beneficiary </td>
                        </tr>
                        <tr>
                            <td>amount</td>
                            <td><code>integer</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>amount to transfer </td>
                        </tr>
                        <tr>
                            <td>country_id</td>
                            <td><code>integer</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Id of country where the money is transferred </td>
                        </tr>
                        <tr>
                            <td>operator</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>name of operator</td>
                        </tr>
                        <tr>
                            <td>raison_transaction</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Raison to tranfer</td>
                        </tr>
                        <tr>
                            <td>relation</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>relation between sender and beneficiary</td>
                        </tr>
                        <tr>
                            <td>origin_fond</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>origin of fonds</td>
                        </tr>
                        <tr>
                            <td>gateway</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>gateway defined the area where the operation is to ocur</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END TABLE HOVER -->
        </div>
        <div class="col-md-5">
            <!-- TABLE HOVER -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Response</h3>
                </div>
                <div class="panel-body">
								<pre>

{
  "status": "success",
  "code": 200,
  "message": "OK",
  "data": {
    "numero": "WTC15042025339857851181",
    "status": "en validation",
    "amount_total": 500
  }
}

                                </pre>
                </div>
            </div>
            <!-- END TABLE HOVER -->
        </div>
    </div>
@endsection
