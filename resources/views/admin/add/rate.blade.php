@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add rate {{$country->name}}</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{count($rates)}} items.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner card-bordered mb-3">
                    <form method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-label" for="default-01">Amount begin</label>
                                <div class="form-control-wrap">
                                    <input name="amount_begin" type="text" class="form-control" id="default-01" placeholder="mount begin">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="default-01">Amount End</label>
                                <div class="form-control-wrap">
                                    <input name="amount_end" type="text" class="form-control" id="default-01" placeholder="mount begin">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="default-01">Value</label>
                                <div class="form-control-wrap">
                                    <input name="value" type="text" class="form-control" id="default-01" placeholder="mount begin">
                                </div>
                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>


                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist is-compact">
                        <div class="nk-tb-item nk-tb-head bg-dark">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid">
                                    <label class="custom-control-label" for="uid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></div>
                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Amount Begin</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Amount end</span></div>
                            <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Value</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-end">
                            </div>
                        </div>
                        @foreach($rates as $item)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                        <label class="custom-control-label" for="uid1"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{$item->country->name}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{$item->amount_begin}}</span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span>{{$item->amount_end}}</span>
                                </div>

                                <div class="nk-tb-col tb-col-xxl">
                                    <span>{{$item->value}}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-2">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="btn btn-sm btn-icon btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    </div><!-- .nk-tb-list -->
                </div>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div>

@endsection
