@extends('admin.layout')
@section('content')
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Sender details / <strong class="text-primary small">{{$sender->first_name}}</strong></h3>
                    <div class="nk-block-des text-soft">
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="{{route('admin.senders')}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    <a href="{{route('admin.senders')}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="row gy-5">
                <div class="col-lg-12">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Sender Information</h5>
                            <p>Basic info, like name, phone, address, country etc.</p>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <ul class="data-list is-compact">
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">First Name</div>
                                    <div class="data-value">{{$sender->first_name}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Last Name</div>
                                    <div class="data-value">{{$sender->last_name}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Email Address</div>
                                    <div class="data-value">{{$sender->email}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Phone Number</div>
                                    <div class="data-value text-soft">{{$sender->phone}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Date of Birth</div>
                                    <div class="data-value">{{$sender->date_birth}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Full Address</div>
                                    <div class="data-value">{{$sender->address}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Country of Residence</div>
                                    <div class="data-value">{{$sender->country}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Document ID</div>
                                    <div class="data-value">{{$sender->num_document}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Document Type</div>
                                    <div class="data-value">{{$sender->identification_document}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Expired document</div>
                                    <div class="data-value text-break">{{$sender->expired_document}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Occupation</div>
                                    <div class="data-value">
                                        {{$sender->occupation}}
                                    </div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Civility</div>
                                    <div class="data-value">
                                        {{$sender->civility}}
                                    </div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Gender</div>
                                    <div class="data-value">
                                        {{$sender->gender}}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .nk-block -->
    </div>
@endsection
