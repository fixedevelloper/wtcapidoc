@extends('secure.layout')
@section('content')

    <div class="nk-block">

          {{--      <livewire:MakeDeposit/>
               <livewire:UploadFile/>--}}
        <div class="components-preview wide-md mx-auto">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub"><a class="back-to" href="{{route('secure.deposits')}}"><em class="icon ni ni-arrow-left"></em><span>Deposits</span></a></div>
                    <h2 class="nk-block-title fw-normal">Make deposit </h2>
                    <div class="nk-block-des">
                        <p class="lead"></p>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card card-bordered">
                    <form method="POST" enctype="multipart/form-data" action="{{route('secure.make_deposit')}}" class="nk-stepper stepper-init is-alter nk-stepper-s1"
                          id="stepper-creat" style="display: block;" data-step-current="first">
                        <div class="row g-0 col-sep col-sep-md col-sep-xl">
                            <div class="col-md-4 col-xl-4">
                                <div class="card-inner">
                                    <ul class="nk-stepper-nav nk-stepper-nav-s1 stepper-nav is-vr">
                                        <li class="current">
                                            <div class="step-item">
                                                <div class="step-text">
                                                    <div class="lead-text">Intro</div>
                                                    <div class="sub-text">Information deposit</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="step-item">
                                                <div class="step-text">
                                                    <div class="lead-text">Make deposit</div>
                                                    <div class="sub-text">Define method</div>
                                                </div>
                                            </div>
                                        </li>
                                        {{--                                    <li>
                                                                                <div class="step-item">
                                                                                    <div class="step-text">
                                                                                        <div class="lead-text">Team Members</div>
                                                                                        <div class="sub-text">Select who is working</div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="step-item">
                                                                                    <div class="step-text">
                                                                                        <div class="lead-text">More Info</div>
                                                                                        <div class="sub-text">Looking for more information</div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>--}}
                                        <li>
                                            <div class="step-item">
                                                <div class="step-text">
                                                    <div class="lead-text">Completed</div>
                                                    <div class="sub-text">Review and Submit</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 col-xl-8">
                                <div class="card-inner">
                                    <div class="nk-stepper-content">
                                        <div class="nk-stepper-steps stepper-steps">
                                            <div class="nk-stepper-step active">
                                                <h5 class="title mb-3">Information deposit</h5>
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="cp1-project-name">Your Name</label>
                                                            <div class="form-control-wrap">
                                                                <input  type="text" class="form-control invalid" id="cp1-project-name" name="name" required="" aria-describedby="cp1-project-name-error">
                                                                <span id="cp1-project-name-error" class="invalid">This field is required.</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="cp1-project-description">Country</label>
                                                            <div class="form-control-wrap">
                                                                <select  id="country" required name="country"  class="form-select"  aria-label="Floating label select example">
                                                                    @foreach($countries as $item)
                                                                        <option data-id="{{$item->id}}" value="{{$item->codeIso2}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span id="cp1-project-description-error" class="invalid">This field is required.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Deposit Type</label>
                                                            <div class="form-control-wrap">
                                                                <ul class="custom-control-group">
                                                                    <li>
                                                                        <div class="custom-control custom-radio checked">
                                                                            <input  type="radio"
                                                                                    class="custom-control-input valid"
                                                                                    name="type"
                                                                                    id="cp1-public-project" value="manuel" required="" aria-describedby="cp1-project-type-error" aria-invalid="false">
                                                                            <label class="custom-control-label" for="cp1-public-project">Manuel</label>
                                                                            <span id="cp1-project-type-error" class="invalid" style="display: none;"></span></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-radio checked">
                                                                            <input  type="radio" class="custom-control-input valid" name="type" id="cp1-mobil-money-project"
                                                                                    value="mobil_money" required="" aria-describedby="cp1-project-type-error" aria-invalid="false">
                                                                            <label class="custom-control-label" for="cp1-mobil-money-project">Mobil money</label>
                                                                            <span id="cp1-project-type-error" class="invalid" style="display: none;"></span></div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="custom-control custom-radio">
                                                                            <input  type="radio"
                                                                                    class="custom-control-input valid" name="type"
                                                                                    id="cp1-private-project" value="virement_bank" required="">
                                                                            <label class="custom-control-label" for="cp1-private-project">Bank virement</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-stepper-step">
                                                <h5 class="title mb-4">Make deposit</h5>
                                                <div class="row g-3" id="manuel">

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cp1-project-amount">Amount</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number" class="form-control invalid" id="cp1-project-amount"
                                                                            name="amount" required="" aria-describedby="cp1-project-amount-error">
                                                                    <span id="cp1-project-amount-error" class="invalid">This field is required.</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cp1-project-phone">Phone</label>
                                                                <div class="form-control-wrap">
                                                                    <input  type="text" class="form-control invalid" id="cp1-project-phone"
                                                                            name="phone" required="" aria-describedby="cp1-project-phone-error">
                                                                    <span id="cp1-project-phone-error" class="invalid">This field is required.</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block-content">
                                                            <div class="nk-block-content-head mb-3">
                                                                <h5>Instruction!</h5>
                                                                <p>Please make the deposit on one of the numbers according to your area of ​​the continent</p>
                                                                <ul>
                                                                    <li>Central africa: +242 06 444 9019</li>
                                                                    <li>west africa: +221 06 444 9019</li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="row g-3" id="mobile_money">
                                                </div>
                                                <div class="row g-3" id="virement_bank">
                                                </div>

                                                </div>

                                            {{--        <div class="nk-stepper-step">
                                                        <h5 class="title mb-4">Team Members</h5>
                                                        <ul class="row g-3">
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-1" value="cp1-team-1" required="">
                                                                    <label class="custom-control-label" for="cp1-team-1">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq">
                                                                                                            <img src="./images/avatar/c-sm.jpg" alt="">
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Keith Jensen</span>
                                                                                                            <span class="sub-text">Senior Developer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-2" value="cp1-team-2" required="">
                                                                    <label class="custom-control-label" for="cp1-team-2">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq">
                                                                                                            <img src="./images/avatar/b-sm.jpg" alt="">
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Stefan Zakrisson</span>
                                                                                                            <span class="sub-text">Senior Developer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-3" value="cp1-team-3" required="">
                                                                    <label class="custom-control-label" for="cp1-team-3">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq bg-purple">
                                                                                                            <span>DM</span>
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Daisy Morgan</span>
                                                                                                            <span class="sub-text">UI/UX Designer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-4" value="cp1-team-4" required="">
                                                                    <label class="custom-control-label" for="cp1-team-4">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq">
                                                                                                            <img src="./images/avatar/a-sm.jpg" alt="">
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Stefan Harary</span>
                                                                                                            <span class="sub-text">Software Engineer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-5" value="cp1-team-5" required="">
                                                                    <label class="custom-control-label" for="cp1-team-5">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq">
                                                                                                            <img src="./images/avatar/d-sm.jpg" alt="">
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Michiel Berende</span>
                                                                                                            <span class="sub-text">Senior Developer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li class="col-sm-6">
                                                                <div class="custom-control custom-control-sm custom-control-pro custom-checkbox custom-control-full">
                                                                    <input type="checkbox" class="custom-control-input" name="cp1-project-team" id="cp1-team-6" value="cp1-team-6" required="">
                                                                    <label class="custom-control-label" for="cp1-team-6">
                                                                                                    <span class="user-card">
                                                                                                        <span class="user-avatar sq bg-warning">
                                                                                                            <span>JR</span>
                                                                                                        </span>
                                                                                                        <span class="user-info">
                                                                                                            <span class="lead-text">Jonathan Rios</span>
                                                                                                            <span class="sub-text">Senior Developer</span>
                                                                                                        </span>
                                                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-stepper-step">
                                                        <h5 class="title mb-3">More Info</h5>
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="cp1-project-client">Client</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="cp1-project-client" name="cp1-project-client" placeholder="Client or Company name" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="cp1-project-lead">Lead</label>
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2 select2-hidden-accessible" id="cp1-project-lead" name="cp1-project-lead" data-placeholder="Select Lead" required="" data-select2-id="cp1-project-lead" tabindex="-1" aria-hidden="true">
                                                                            <option value="" data-select2-id="2"></option>
                                                                            <option value="Keith_Jensen">Keith Jensen</option>
                                                                            <option value="Stefan_Zakrisson">Stefan Zakrisson</option>
                                                                            <option value="Daisy_Morgan">Daisy Morgan</option>
                                                                            <option value="Stefan_Harary">Stefan Harary</option>
                                                                            <option value="Michiel_Berende">Michiel Berende</option>
                                                                            <option value="Jonathan_Rios">Jonathan Rios</option>
                                                                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-cp1-project-lead-container"><span class="select2-selection__rendered" id="select2-cp1-project-lead-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Lead</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="cp1-project-deadline">Deadline</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control date-picker" id="cp1-project-deadline" name="cp1-project-deadline" placeholder="mm/dd/yyyy" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="cp1-project-tags">Tags</label>
                                                                    <div class="form-control-wrap">
                                                                        <tags class="tagify form-control js-tagify tagify--noTags tagify--empty" required="" tabindex="-1">
                                                                            <span contenteditable="" data-placeholder="Add Tags" aria-placeholder="Add Tags" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                                                                        </tags><input type="text" placeholder="Add Tags" class="form-control js-tagify tagify" id="cp1-project-tags" name="cp1-project-tags" required="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Project Action</label>
                                                                    <div class="form-control-wrap">
                                                                        <ul class="custom-control-group gx-4">
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="cp1-follow-project" id="cp1-follow-project" value="follow_project">
                                                                                    <label class="custom-control-label" for="cp1-follow-project">Follow Project</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" name="cp1-save-project" id="cp1-save-project" value="save_project">
                                                                                    <label class="custom-control-label" for="cp1-save-project">Save Project</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>--}}
                                            <div class="nk-stepper-step">
                                                <h5 class="title mb-2">Preview Deposit!</h5>
                                                <p class="text-soft">Please take a screenshot of the payment and submit it using the form.
                                                    Our team will verify it within 30 minutes.</p>
                                                <div class="gfx w-auto mx-auto">

                                                        <div class="col-md-4 col-sm-4 text-center">
                                                            <input name="proof" type="file"  id="imageUpload" accept="image/*" class="form-control custom-input-image">
                                                            <div class="card p-4 border border-3">
                                                                <i class="ni ni-camera-fill ni-view-x3"></i>
                                                                <label for="imageUpload" class="label_upload">Select file</label>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <p><strong>Aperçu :</strong></p>
                                                            <img id="preview" src="#" width="200" class="rounded shadow">
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                       <ul class="nk-stepper-pagination pt-4 gx-4 gy-2 stepper-pagination">
                                            <li class="step-prev" style="display: none;"><button class="btn btn-dim btn-primary">Prev</button></li>
                                            <li class="step-next" style="display: block;"><button class="btn btn-primary">Next</button></li>
                                            <li class="step-submit" style="display: none;"><button id="submitBtn"  type="button" class="btn btn-primary">Submit</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div><!-- .nk-block -->
        </div>
            </div><!-- .card-inner-group -->

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#submitBtn').on('click', function() {
                // Optional: add validation or other logic here
                $('#stepper-creat').submit();
            });
            $('#imageUpload').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).show();
                    }

                    reader.readAsDataURL(file);
                } else {
                    $('#preview').hide();
                }
            });
        });
    </script>
@endpush
