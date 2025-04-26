@extends('secure.layout')
@section('content')
<div class="nk-content-body">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transaction / <strong class="text-primary small">{{$transaction->customer->user->name}}</strong></h3>
                <div class="nk-block-des text-soft">
                    <ul class="list-inline">
                        <li>Transaction ID: <span class="text-base">{{$transaction->number_transaction}}</span></li>
                        <li>Submited At: <span class="text-base">{{$transaction->created_at}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{route('secure.transferList')}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                <a href="{{route('secure.transferList')}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row gy-5">
            <div class="col-lg-5">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Transaction Info</h5>
                        <p>Submission date, approve date, status etc.</p>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Submitted By</div>
                                <div class="data-value">{{$transaction->customer->user->name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Submitted At</div>
                                <div class="data-value">{{$transaction->created_at}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Status</div>
                                <div class="data-value">
                                    <span class="{{ $transaction->stringStatus->class }}">{{$transaction->stringStatus->value}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Country</div>
                                <div class="data-value">{{$transaction->gatewayItem->country->name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">City</div>
                                <div class="data-value">{{$transaction->city}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Amount Send</div>
                                <div class="data-value">
                                    <span>{{number_format($transaction['amount_total'],2)}} {{$transaction->gatewayItem->country->currency}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Amount payable</div>
                                <div class="data-value">{{number_format($transaction['amount']+$transaction['rate'],2)}} XAF</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Method</div>
                                <div class="data-value">{{$transaction['method']}} </div>
                            </div>
                        </li>
                        @if($transaction['method']==\App\Helpers\Helper::METHODMOBIL)
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Account Number</div>
                                    <div class="data-value">{{$transaction['accountNumber']}} </div>
                                </div>
                            </li>
                        @endif
                        @if($transaction['method']==\App\Helpers\Helper::METHODBANK)
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Bank</div>
                                <div class="data-value">{{$transaction['gatewayItem']['name']}} </div>
                            </div> </li>
                            <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Iban</div>
                                <div class="data-value">{{$transaction['iban']}} </div>
                            </div>
                            </li>
                            <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Account Number</div>
                                <div class="data-value">{{$transaction['accountNumber']}} </div>
                            </div>
                        </li>
                        @endif
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Relation</div>
                                <div class="data-value">{{$transaction['relation']}} </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Origin fond</div>
                                <div class="data-value">{{$transaction['origin_fond']}} </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Motif send</div>
                                <div class="data-value">{{$transaction['motif_send']}} </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .card -->
                <div class="nk-block-head">
                    <div class="nk-block-head-content">

                    </div>
                </div><!-- .nk-block-head -->
                <div class="card card-bordered">
                    <ul class="data-list is-compact">

                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-7">
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
                                <div class="data-value">{{$transaction->sender->first_name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{$transaction->sender->last_name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{$transaction->sender->email}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value text-soft">{{$transaction->sender->phone}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Date of Birth</div>
                                <div class="data-value">{{$transaction->sender->date_birth}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Full Address</div>
                                <div class="data-value">{{$transaction->sender->address}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Country of Residence</div>
                                <div class="data-value">{{$transaction->sender->country}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document ID</div>
                                <div class="data-value">{{$transaction->sender->num_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document Type</div>
                                <div class="data-value">{{$transaction->sender->identification_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Expired document</div>
                                <div class="data-value text-break">{{$transaction->sender->expired_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Occupation</div>
                                <div class="data-value">
                                    {{$transaction->sender->occupation}}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Civility</div>
                                <div class="data-value">
                                    {{$transaction->sender->civility}}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Gender</div>
                                <div class="data-value">
                                    {{$transaction->sender->gender}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title title">Beneficiary Information</h5>
                        <p>Basic info, like name, phone, address, country etc.</p>
                    </div>
                </div>
                <div class="card card-bordered">
                    <ul class="data-list is-compact">
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">First Name</div>
                                <div class="data-value">{{$transaction->beneficiary->first_name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Last Name</div>
                                <div class="data-value">{{$transaction->beneficiary->last_name}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Email Address</div>
                                <div class="data-value">{{$transaction->beneficiary->email}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Phone Number</div>
                                <div class="data-value text-soft">{{$transaction->beneficiary->phone}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Date of Birth</div>
                                <div class="data-value">{{$transaction->beneficiary->date_birth}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Full Address</div>
                                <div class="data-value">{{$transaction->beneficiary->address}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Country of Residence</div>
                                <div class="data-value">{{$transaction->beneficiary->country}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document ID</div>
                                <div class="data-value">{{$transaction->beneficiary->num_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Document Type</div>
                                <div class="data-value">{{$transaction->beneficiary->identification_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Expired document</div>
                                <div class="data-value text-break">{{$transaction->beneficiary->expired_document}}</div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Occupation</div>
                                <div class="data-value">
                                    {{$transaction->beneficiary->occupation}}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Civility</div>
                                <div class="data-value">
                                    {{$transaction->beneficiary->civility}}
                                </div>
                            </div>
                        </li>
                        <li class="data-item">
                            <div class="data-col">
                                <div class="data-label">Gender</div>
                                <div class="data-value">
                                    {{$transaction->beneficiary->gender}}
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
