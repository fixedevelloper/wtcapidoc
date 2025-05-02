@extends('secure.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add Beneficiary</h3>
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
                                        <input  value="{{$beneficiary['first_name']}}" required type="text" name="first_name" class="form-control form-control-outlined form-control-lg" id="first_name" placeholder="First name">
                                        <label class="form-label-outlined" for="first_name">First name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['email']}}" required type="email" name="email" class="form-control form-control-outlined form-control-lg" id="email" placeholder="Email" data-ui="xl">
                                        <label class="form-label-outlined" for="email">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="form-control-wrap ">

                                        <select name="country" class="form-select js-select2 form-select-lg" id="country" data-ui="xl">
                                            @foreach($countries as $item)
                                                <option  @if($beneficiary['country']===$item->codeIso2)selected @endif value="{{$item->codeIso2}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>

                                        <label class="form-label-outlined" for="country">Choose Country</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['zipcode']}}" required type="text" name="zipcode" class="form-control form-control-outlined form-control-lg" id="zipcode" placeholder="Zipcode" data-ui="xl">
                                        <label class="form-label-outlined" for="zipcode">Zipcode</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['num_document']}}" required type="text" name="num_document" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="N° Document" data-ui="xl">
                                        <label class="form-label-outlined" for="outlined">N° Document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['expired_document']}}" required type="date" min="{{date('Y-m-d')}}" name="expired_document"
                                               class="form-control form-control-outlined form-control-lg" id="expired_document" placeholder="Expired Document" data-ui="xl">
                                        <label class="form-label-outlined" for="expired_document">Expired Document</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['last_name']}}" required type="text" name="last_name" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="Last name">
                                        <label class="form-label-outlined" for="outlined">Last name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['phone']}}" required type="text" name="phone" class="form-control form-control-outlined form-control-lg" id="phone" placeholder="Phone">
                                        <label class="form-label-outlined" for="phone">Phone</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="gender" class="form-select js-select2 form-select-lg" data-ui="xl" id="gender-select">
                                            <option @if($beneficiary['gender']==='M')selected @endif value="M">Male</option>
                                            <option @if($beneficiary['gender']==='F')selected @endif value="F">Female</option>
                                        </select>
                                        <label class="form-label-outlined" for="gender-select">Gender</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="civility" class="form-select js-select2 form-select-lg" data-ui="xl" id="civility-select">
                                            <option @if($beneficiary['civility']==='Maried')selected @endif value="Maried">Maried</option>
                                            <option @if($beneficiary['civility']==='Single')selected @endif value="Single">Single</option>
                                            <option @if($beneficiary['civility']==='Others')selected @endif value="Others">Others</option>
                                        </select>
                                        <label class="form-label-outlined" for="civility-select">Civility</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="identification_document" class="form-select js-select2 form-select-lg" data-ui="xl" id="identification_document-select">
                                            <option @if($beneficiary['identification_document']==='PP')selected @endif value="PP">Passport</option>
                                            <option @if($beneficiary['identification_document']==='CNI')selected @endif value="CNI">ID card</option>
                                        </select>
                                        <label class="form-label-outlined" for="identification_document-select">Identification document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input value="{{$beneficiary['date_birth']}}" required type="date" max="{{date('Y-m-d')}}" name="date_birth"
                                               class="form-control form-control-outlined form-control-lg" id="date_birth" placeholder="Date birth" data-ui="xl">
                                        <label class="form-label-outlined" for="date_birth">Date birth</label>
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
