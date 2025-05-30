@extends('secure.layout')
@section('content')

                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Transction History</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total {{count($transactions)}} items.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em>Add transction</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt">
                                                <li><a href="{{route('secure.make_mobil')}}"><span>Mobil</span></a></li>
                                                <li><a href="{{route('secure.make_bank')}}"><span>Bank</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">All transactions</h5>
                                    </div>
                                    <div class="card-tools me-n1">
                                        <ul class="btn-toolbar">
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                            </li><!-- li -->
                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-setting"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-check">
                                                            <li><span>Show</span></li>
                                                            <li class="active"><a href="#">10</a></li>
                                                            <li><a href="#">20</a></li>
                                                            <li><a href="#">50</a></li>
                                                        </ul>
                                                        <ul class="link-check">
                                                            <li><span>Order</span></li>
                                                            <li class="active"><a href="#">DESC</a></li>
                                                            <li><a href="#">ASC</a></li>
                                                        </ul>
                                                        <ul class="link-check">
                                                            <li><span>Density</span></li>
                                                            <li class="active"><a href="#">Regular</a></li>
                                                            <li><a href="#">Compact</a></li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .dropdown -->
                                            </li><!-- li -->
                                        </ul><!-- .btn-toolbar -->
                                    </div><!-- card-tools -->
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <form>
                                            <input name="search" type="text" class="form-control form-control-sm border-transparent form-focus-none"
                                                   placeholder="Quick search by sender,date and n°transaction">
                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button> </form>
                                        </div>
                                    </div><!-- card-search -->
                                </div><!-- .card-title-group -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-ulist">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                <label class="custom-control-label" for="uid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col"><span class="sub-text">Sender</span></div>
                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Amount Send</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Amount receive</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Beneficiary</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Total Fees &amp; Charges</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Mode</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Operator</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools text-end">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                    <ul class="link-tidy sm no-bdr">
                                                        <li>
                                                            <div class="custom-control custom-control-sm custom-checkbox checked">
                                                                <input type="checkbox" class="custom-control-input" checked="" id="bl">
                                                                <label class="custom-control-label" for="bl">Country</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" checked="" id="ph">
                                                                <label class="custom-control-label" for="ph">Phone</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control-sm custom-checkbox checked">
                                                                <input type="checkbox" class="custom-control-input" id="vri">
                                                                <label class="custom-control-label" for="vri">Gender</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control-sm custom-checkbox checked">
                                                                <input type="checkbox" class="custom-control-input" id="vri">
                                                                <label class="custom-control-label" for="vri">Civility</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-control-sm custom-checkbox checked">
                                                                <input type="checkbox" class="custom-control-input" id="st">
                                                                <label class="custom-control-label" for="st">Occupation</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach($transactions as $item)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="{{$item['numero_identifiant']}}">
                                                    <label class="custom-control-label" for="{{$item['numero_identifiant']}}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>{{ substr($item['sender']['first_name'],0,1) }}{{ substr($item['sender']['last_name'],0,1) }}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead">
                                                            {{$item['sender']['first_name']}} {{$item['sender']['last_name']}}
                                                            <span class="dot dot-warning d-md-none ms-1">

                                                            </span></span>
                                                        <span>{{$item['sender']['email']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount">{{$item->gatewayItem->country->name}} </span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span>{{number_format($item['amount']+$item['rate'],2)}} XAF</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{number_format($item['amount_total'],2)}} {{$item->gatewayItem->country->currency}}</span>
                                            </div>

                                            <div class="nk-tb-col tb-col-sm">
                                                <div class="user-info">
                                                    <span class="tb-lead">{{$item['beneficiary']['first_name']}}</span>
                                                    <span>{{$item['beneficiary']['last_name']}}</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="amount">{{number_format($item['rate'],2)}} XAF</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{$item['created_at']}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{$item['method']}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="{{ $item->stringStatus->class }}">{{$item->stringStatus->value}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{$item['gatewayItem']['name']}}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{route('secure.transaction_detail',['numero_identifiant'=>$item['number_transaction']])}}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div>

                            </div><!-- .card-inner -->
                            <div class="card-inner">
                                {{$transactions->links('vendor.pagination.custom-paginator')}}
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div>

@endsection
