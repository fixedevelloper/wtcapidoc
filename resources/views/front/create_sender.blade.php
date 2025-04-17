@extends('base')

@section('content')

    <h3 class="page-title">Create sender</h3>
    <h4 class="page-title">URL: <span class="text-success">api/senders</span></h4>
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
                            <td>first_name</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>first_name sender </td>
                        </tr>
                        <tr>
                            <td>last_name</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>last_name sender </td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>email sender </td>
                        </tr>
                        <tr>
                            <td>gender</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>gender sender. M -> Male or F -> Female </td>
                        </tr>
                        <tr>
                            <td>civility</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>civility sender . Mr,Mme, Mlle </td>
                        </tr>
                        <tr>
                            <td>phone</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>phone sender </td>
                        </tr>
                        <tr>
                            <td>occupation</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>occupation sender </td>
                        </tr>
                        <tr>
                            <td>identification_document</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Type of identification document. the value can be: PP:Passeport, CNI: National Idendity Card </td>
                        </tr>
                        <tr>
                            <td>expired_document</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Date of expired document Exp: 2025-02-14</td>
                        </tr>
                        <tr>
                            <td>num_document</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Number of document </td>
                        </tr>
                        <tr>
                            <td>country</td>
                            <td><code>string</code></td>
                            <td><code>Body</code></td>
                            <td><code>Required</code></td>
                            <td>Code Iso2 of country sender . EX: CM </td>
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
    "id": 124,
    "first_name": "John most",
    "last_name": "Alphonse",
    "email": "Mecanicien",
    "phone": "675066919",
    "num_document": "895411125441",
    "identification_document": "CNI",
    "country": "CM",
    "expired_document": "2025-02-18T00:00:00+00:00"
  }
}


                                </pre>
                </div>
            </div>
            <!-- END TABLE HOVER -->
        </div>
    </div>
@endsection
