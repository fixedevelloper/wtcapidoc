@extends('sandbox.layout')
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
                                        <input required type="text" name="first_name" class="form-control form-control-outlined form-control-lg" id="outlined" placeholder="First name">
                                        <label class="form-label-outlined" for="outlined">First name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="text" name="email" class="form-control form-control-outlined form-control-lg" id="email" placeholder="Email" data-ui="xl">
                                        <label class="form-label-outlined" for="email">Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <select id="country" required name="country"  class="form-select"  aria-label="Floating label select example">
                                            @foreach($countries as $item)
                                                <option data-id="{{$item->id}}" value="{{$item->codeIso2}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="city-select">Choose country</label>
                                    </div>
                                    {{-- <div class="form-control-wrap ">

                                         <select required name="country" class="form-select  form-select-lg" id="country" data-ui="xl">
                                             @foreach($countries as $item)
                                                 <option data-id="{{$item->id}}" value="{{$item->codeIso2}}">{{$item->name}}</option>
                                             @endforeach
                                         </select>

                                         <label class="form-label-outlined" for="country">Choose Country</label>
                                     </div>--}}
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="text" name="address" class="form-control form-control-outlined form-control-lg" id="address" placeholder="Address" data-ui="xl">
                                        <label class="form-label-outlined" for="address">Address</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="gender" class="form-select js-select2 form-select-lg" data-ui="xl" id="gender-select">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <label class="form-label-outlined" for="gender-select">Gender</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="text" name="num_document" class="form-control form-control-outlined form-control-lg" id="num_document" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="num_document">N° Document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="date" min="{{date('Y-m-d')}}" name="expired_document" class="form-control form-control-outlined form-control-lg" id="expired_document" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="expired_document">Expired Document</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="text" name="last_name" class="form-control form-control-outlined form-control-lg" id="last_name" placeholder="Last name">
                                        <label class="form-label-outlined" for="last_name">Last name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap form-floating">
                                        <input required type="text" name="phone" class="form-control form-control-outline form-control-lg" id="phone" placeholder="Phone" data-ui="xl" >
                                        <label class="form-label-outline" for="phone">Phone</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-floating">
                                        <select id="city-select" required name="numCity"  class="form-select"  aria-label="Floating label select example">

                                        </select>
                                        <label for="city-select">Choose city</label>
                                    </div>
                                    {{--  <div class="form-control-wrap ">
                                              <select required name="numCity" class="form-select form-select-lgl" id="city-select" data-ui="xl" >
                                              </select>
                                              <label class="form-label-outlined" for="city-select">Choose City</label>
                                          </div>--}}
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required type="text" name="occupation" class="form-control form-control-outlined form-control-lg" id="occupation" placeholder="Occupation" data-ui="xl">
                                        <label class="form-label-outlined" for="occupation">Occupation</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap ">
                                        <select required name="civility" class="form-select js-select2 form-select-lg" data-ui="xl" id="civility-select">
                                            <option value="Maried">Maried</option>
                                            <option value="Single">Single</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <label class="form-label-outlined" for="civility-select">Civility</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select name="identification_document" class="form-select js-select2 form-select-lg" data-ui="xl" id="identification_document-select">
                                            <option value="PP">Passport</option>
                                            <option value="CNI">ID card</option>
                                        </select>
                                        <label class="form-label-outlined" for="identification_document-select">Identification document</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input required max="{{date('Y-m-d')}}" type="date" name="date_birth"
                                               class="form-control form-control-outlined form-control-lg" id="date_birth" placeholder="Occupation" data-ui="xl">
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
@push('js')
    <script type="text/javascript">
        $(function () {
            $('.js-select2').on("select2:select", function (e) { log("select2:select", e); });
            $('#country').on('change', function(e) {
                $.ajax({
                    url: configs.routes.get_ajax_cities,
                    type: "GET",
                    dataType: "JSON",
                    data: {
                        'country_id': $('#country option:selected').data('id')
                    },
                    success: function (data) {
                        $('#city-select').html('')
                        $('#city-select').append('<option>Choose city</option>')
                        $.each(data.data, function (index, item) {
                            $('#city-select').append('<option value="'+item["name"]+'">'+item["name"]+'</option>')
                        })
                    },
                    error: function (err) {
                        alert("An error ocurred while loading data ...");
                    }
                });
            })
        })
    </script>
@endpush
