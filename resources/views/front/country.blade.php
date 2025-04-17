@extends('base')

@section('content')

    <h3 class="page-title">Get countries</h3>
    <h4 class="page-title">URL: <span class="text-success">api/countries</span></h4>
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
      "id": 1,
      "libelle": "CAMEROUN",
      "code": "237",
      "codeIso2": "CM"
    },
    {
      "id": 2,
      "libelle": "REPUBLIQUE DU CONGO (RDC)",
      "code": "243",
      "codeIso2": "CD"
    },
    {
      "id": 3,
      "libelle": "REPUBLIQUE DU CONGO",
      "code": "242",
      "codeIso2": "CG"
    },
    {
      "id": 4,
      "libelle": "FRANCE",
      "code": "+336",
      "codeIso2": "FR"
    },
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
