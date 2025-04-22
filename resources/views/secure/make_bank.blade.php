@extends('secure.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Transfer Bank</h3>
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
                                            <label class="form-label" for="sender">Choose Sender</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="numSender" class="form-control" id="sender">
                                                        <option>Choose sender</option>
                                                        @foreach($senders as $item)
                                                            <option value="{{$item['num']}}">{{$item['first_name']}} {{$item['last_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="country">Choose Country</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="countryCode" class="form-control" id="country">
                                                        @foreach($countries as $item)
                                                            <option value="{{$item['codeIso2']}}">{{$item['libelle']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="default-06">Origin fond</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="origin_fond" class="form-control" id="default-06">
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
                                                    <select name="numBeneficiary" class="form-control" id="beneficiary">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="city">Choose City</label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select name="numCity" class="form-control" id="city">
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
                                            <select name="relation" class="form-control" id="default-06">
                                                @foreach($relactions as $item)
                                                    <option value="{{$item['name']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="wallet">Choose wallet</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select name="gateway" class="form-control" id="wallet">
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
                                            <select name="operator" class="form-control" id="operator">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-0">
                                    <div class="col-md-6">
                                        <div class="form-control-wrap">
                                            <label class="form-label" for="default-06">Iban</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg"><em class="icon ni ni-inbox"></em></span>
                                                </div>
                                                <input name="iban" type="text" id="iban" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-control-wrap">
                                            <label class="form-label" for="default-06">Account number</label>
                                            <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg"><em class="icon ni ni-account-setting"></em></span>
                                                </div>
                                                <input name="accountNumber" type="text" id="account_number" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
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
                                        <input name="amount" type="text" id="amount" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
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
                                                            <i class="ni ni-exchange-alt"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span>Exchange Rate</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="request-amount"><span id="exchange_rate_text">1 XAF  =  1XAF</span></span>
                                                </div>
                                            </div>
                                            <div class="preview-list-item">
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
                                            </div>
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="las la-battery-half"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span>Total Fees &amp; Charges</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="fees">0.00 EUR</span>
                                                </div>
                                            </div>

                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="las la-money-check-alt"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span class="">Will Get</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="text--success ">8.50 EUR</span>
                                                </div>
                                            </div>
                                            <div class="preview-list-item">
                                                <div class="preview-list-left">
                                                    <div class="preview-list-user-wrapper">
                                                        <div class="preview-list-user-icon">
                                                            <i class="las la-money-check-alt"></i>
                                                        </div>
                                                        <div class="preview-list-user-content">
                                                            <span class="last">Total Payable</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="preview-list-right">
                                                    <span class="text--warning last">10.00 XAF</span>
                                                </div>
                                            </div>
                                        </div>
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
                        'numCountry': $('#country').val()
                    },
                    success: function (data) {
                        $('#city').html('')
                        $('#city').append('<option>Choose city</option>')
                        $.each(data.data, function (index, item) {
                            $('#city').append('<option value="'+item["num"]+'">'+item["libelle"]+'</option>')
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
                        'numCountry': $('#country').val(),
                        'gateway': $('#wallet').val()
                    },
                    success: function (data) {
                        $('#operator').html('')
                        $.each(data.data, function (index, item) {
                            $('#operator').append('<option value="'+item["name"]+'">'+item["name"]+'</option>')
                        })
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
            $('#amount').keyup(function () {
                $('#amount_text').text($('#amount').val())

            })
        })
    </script>
@endpush
