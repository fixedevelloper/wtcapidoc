@extends('sandbox.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Transfer Mobil</h3>
                <div class="nk-block-des text-soft">
                    <p></p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title"></h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <form method="POST">
                    @csrf
                    <div class="card-inner p-2">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="sende">Choose Sender</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select required name="numSender" class="form-control" id="sende">
                                                        @foreach($senders as $item)
                                                            <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="country">Choose Country</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select required name="countryCode" class="form-control" id="country">
                                                        <option>Choose Country</option>
                                                        @foreach($countries as $item)
                                                            <option data-currency="{{$item->country->currency}}" value="{{$item->country->id}}">{{$item->country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="default-06">Origin fond</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select required name="origin_fond" class="form-control" id="default-06">
                                                        @foreach($originFonds as $item)
                                                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="beneficiary">Choose Beneficiary</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="numBeneficiary" class="form-control" id="beneficiar">
                                                        @foreach($beneficiaries as $item)
                                                            <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="city">Choose City</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select required name="numCity" class="form-control" id="city">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="default-06">Motif to send</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="raison_transaction" class="form-control lg" id="default-06">
                                                        @foreach($raisons as $item)
                                                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-06">Relation</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select required name="relation" class="form-control" id="default-06">
                                                @foreach($relactions as $item)
                                                    <option value="{{$item['name']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="wallet">Choose Wallet</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select required name="wallet" class="form-control" id="wallet">
                                                <option >Choose wallet</option>
                                                @foreach($wallets as $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="operator">Choose operator</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select required name="gateway_id" class="form-control" id="operator">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-0">
                                    <div class="col-md-12">
                                        <div class="form-control-wrap">
                                            <label class="form-label" for="default-06">Phone number</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg"><em class="icon ni ni-account-setting"></em></span>
                                                </div>
                                                <input required name="accountNumber" type="text" id="account_number" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-control-wrap mt-2">
                                    <label class="form-label" for="default-06">Amount</label>
                                    <div class="input-group input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-lg"><em class="icon ni ni-money"></em></span>
                                        </div>
                                        <input required name="amount" type="text" id="amount" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="dash-payment-item active">
                                    <div class="dash-payment-title-area">
                                        <span class="dash-payment-badge">!</span>
                                        <h5 class="title">Transaction Information</h5>
                                    </div>
                                    <div class="dash-payment-body">
                                        <div class="preview-list-wrapper">
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="ni ni-money"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span>Entered Amount</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="request-amount" id="request-amount"><span id="amount_text">0.0</span> XAF</span>
                                                </div>
                                            </div>
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="ni ni-exchange"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span>Exchange Rate</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="request-amount"><span>1 XAF  =  <span id="exchange_rate_text"></span> <span id="exchange_rate_currency"></span></span></span>
                                                </div>
                                            </div>
                                            {{--    <div class="preview-list-item">
                                                    <div class="preview-list-left">
                                                        <div class="preview-list-user-wrapper">
                                                            <div class="preview-list-user-icon">
                                                                <i class="lab la-get-pocket"></i>
                                                            </div>
                                                            <div class="preview-list-user-content">
                                                                <span>Conversion Amount</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="preview-list-right">
                                                        <span class="conversion"><span id="conversion_text">1</span> XAF</span>
                                                    </div>
                                                </div>--}}
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="ni ni-bar-chart"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span>Total Fees &amp; Charges</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="fees" ><span id="fees">0.00 </span> XAF</span>
                                                </div>
                                            </div>

                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="ni ni-money"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span class="">Will Send</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="text--success "><span id="will_send"></span> <span id="will_send_currency"></span></span>
                                                </div>
                                            </div>
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="ni ni-money"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span class="last">Total Payable</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="text--warning last"><span id="payable"></span> XAF</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-3 mb-3 text-danger text-md-center">Notice: You are in a test environment</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <button class="btn btn-xl btn-primary btn-block"><span>Send</span><em class="icon ni ni-send"></em></button>
                    </div><!-- .card-inner -->
                </form>

            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div>
@endsection
@push('js')

    <script type="text/javascript">
        // Display an info toast with no title
        $(function () {
            $('#sender').change(function () {

                $.ajax({
                    url: configs.routes.get_ajax_beneficiaries,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'numSender': $('#sender').val()
                    },
                    success: function (data) {
                        $('#beneficiary').html('')
                        $('#beneficiary').append('<option>Choose beneficiary</option>')
                        $.each(data.data, function (index, item) {
                            $('#beneficiary').append('<option  value="'+item["num"]+'">'+item["first_name"]+' '+item["first_name"]+'</option>')
                        })
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
            $('#country').change(function () {

                $.ajax({
                    url: configs.routes.get_ajax_cities,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'country_id': $('#country').val()
                    },
                    success: function (data) {
                        $('#city').html('')
                        $('#city').append('<option>Choose city</option>')
                        $.each(data.data, function (index, item) {
                            $('#city').append('<option value="'+item["name"]+'">'+item["name"]+'</option>')
                        })
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
            $('#wallet').change(function () {

                $.ajax({
                    url: configs.routes.get_ajax_operators,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'country_id': $('#country').val(),
                        'method': $('#wallet').val()
                    },
                    success: function (data) {
                        $('#operator').html('')
                        $.each(data.data, function (index, item) {
                            $('#operator').append('<option value="'+item["id"]+'">'+item["name"]+'</option>')
                        })
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
            $('#amount').keyup(function () {

                $.ajax({
                    url: configs.routes.get_ajax_rate,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'country_id': $('#country').val(),
                        'amount': $('#amount').val()
                    },
                    success: function (data) {
                        if (data.data['status']===0){
                            toastr.error('unauthorized for this country', '503!')
                        }

                        $('#exchange_rate_text').text(data.data['value']['rate'])
                        $('#fees').text(data.data['value']['costs'])
                        $('#payable').text(data.data['value']['total_local'])
                        $('#will_send').text(data.data['value']['total'])
                        $('#exchange_rate_currency').text($("select[name=countryCode] :selected").data('currency'))
                        $('#will_send_currency').text($("select[name=countryCode] :selected").data('currency'))
                        $('#amount_text').text(data.data['value']['amount'])
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });

            })
        })
    </script>
@endpush
