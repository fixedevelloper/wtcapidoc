@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transactions</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{count($transactions)}} items.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">

                        </div><!-- .card-tools -->
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li><!-- li -->
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
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
                                                        </div>
                                                    </div><!-- .dropdown -->
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div><!-- .toggle-wrap -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- .card-tools -->
                    </div><!-- .card-title-group -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid">
                                    <label class="custom-control-label" for="uid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></div>
                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Email</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Company</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Balance</span></div>
                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Last Login</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-end">
                            </div>
                        </div>
                        @foreach($transactions as $item)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="{{$item->id}}">
                                        <label class="custom-control-label" for="{{$item->id}}"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-avatar xs bg-primary">
                                            <span>{{substr($item->user->name,0,2)}}</span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead">{{$item->user->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{$item->country}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span>{{$item->user->email}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{$item->user->phone}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-xxl">
                                    <span>{{$item->balance}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <ul class="list-status">
                                        <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                    </ul>
                                </div>
                                <div class="nk-tb-col tb-col-xxl">
                                    <span>10 Feb 2020</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-status text-success">Active</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-2">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="btn btn-sm btn-icon btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Orders</span></a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <ul class="pagination justify-content-center justify-content-md-start">
                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul><!-- .pagination -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div>
@endsection
