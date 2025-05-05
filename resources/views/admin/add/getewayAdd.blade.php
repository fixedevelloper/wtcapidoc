@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add gateway</h3>

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="components-preview wide-lg mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner-group">
                    <div class="card-inner card-bordered mb-3">
                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="country">Choose Country</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select name="country_id" class="form-control" id="country">
                                            @foreach($countries as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-01">Name</label>
                                <div class="form-control-wrap">
                                    <input name="name" type="text" class="form-control" id="default-01" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="code">Code</label>
                                <div class="form-control-wrap">
                                    <input name="code" type="text" class="form-control" id="code" placeholder="code">
                                </div>
                            </div><div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="payer_code">payer_code</label>
                                    <div class="form-control-wrap">
                                        <input name="payer_code" type="text" class="form-control" id="payer_code" placeholder="payer_code">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="country">Choose Method</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select name="gateway" class="form-control" id="methode">
                                                    <option value="AGENSICPAY">AGENSICPAY</option>
                                                <option value="PAYDUNYA">PAYDUNYA</option>
                                                <option value="WACEPAY">WACEPAY</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="country">Choose Type</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select name="type" class="form-control" id="country">
                                            <option value="MOBIL">MOBIL</option>
                                            <option value="BANK">BANK</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>


                    </div><!-- .card-inner -->

                </div><!-- .card-inner-group -->
            </div><!-- .card -->
        </div>
    </div>


@endsection
