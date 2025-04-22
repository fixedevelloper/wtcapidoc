@extends('secure.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Sender</h3>
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
                </div>
                <form method="POST">
                    @csrf
                    <div class="card-inner">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="first_name" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="First name">
                                        <label class="form-label-outlined" for="outlined">First name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="email" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Email" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="form-control-wrap ">

                                        <select name="country" class="form-select js-select2 form-select-lg" id="default-06" data-ui="xl">
                                            @foreach($countries as $item)
                                                <option value="{{$item['codeIso2']}}">{{$item['libelle']}}</option>
                                            @endforeach
                                        </select>

                                        <label class="form-label-outlined" for="default-06">Choose Country</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="occupation" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">Occupation</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="num_document" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">N° Document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="date" name="expired_document" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">Expired Document</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="last_name" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Last name">
                                        <label class="form-label-outlined" for="outlined">Last name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="text" name="phone" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Phone">
                                        <label class="form-label-outlined" for="outlined">Phone</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="gender" class="form-select js-select2 form-select-lg" data-ui="xl" id="outlined-select">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <label class="form-label-outlined" for="outlined-select">Gender</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="civility" class="form-select js-select2 form-select-lg" data-ui="xl" id="outlined-select">
                                            <option value="Maried">Maried</option>
                                            <option value="Single">Single</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <label class="form-label-outlined" for="outlined-select">Civility</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="identification_document" class="form-select js-select2 form-select-lg" data-ui="xl" id="outlined-select">
                                            <option value="PP">Passport</option>
                                            <option value="CNI">ID card</option>
                                        </select>
                                        <label class="form-label-outlined" for="outlined-select">Identification document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input type="date" name="date_birth" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">Date birth</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <button class="btn btn-xl btn-primary btn-block"><span>Send</span><em class="icon ni ni-send"></em></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
