@extends('base')

@section('content')

    <h3 class="page-title">Get Operators</h3>
    <h4 class="page-title">URL: <span class="text-success">api/operators/country</span></h4>
    <div class="row">
        <div class="col-md-7">
            <!-- TABLE HOVER -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Request</h3>
                </div>
                <div class="panel-body">
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
                            <td>country_id</td>
                            <td><code>string</code></td>
                            <td><code>Header</code></td>
                            <td><code>Required</code></td>
                            <td>Id country </td>
                        </tr>
                        <tr>
                            <td>gateway</td>
                            <td><code>string</code></td>
                            <td><code>Header</code></td>
                            <td><code>Required</code></td>
                            <td>gateway </td>
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
  "data": [
    {
      "name": "BGFIBANK CAMEROUN SA",
      "short": "BGFICMCX"
    },
    {
      "name": "Commercial Bank of Cameroun",
      "short": "CBCDCMCX"
    },
    {
      "name": "Banque Internationale du Cameroun pour lEpargne et le Credit",
      "short": "ICLRCMCX"
    },
    {
      "name": "CCA Bank",
      "short": "CCADCMCX"
    },
    {
      "name": "AFRILAND FIRST BANK",
      "short": "CCEICMCX"
    }
    ...
  ]
}


                                </pre>
                </div>
            </div>
            <!-- END TABLE HOVER -->
        </div>
    </div>
@endsection
