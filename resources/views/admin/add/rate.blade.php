@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add rate for {{$customer->user->name}}</h3>
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
                                <label class="form-label" for="country">Choose Country</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select name="countryCode" class="form-control" id="country">
                                            @foreach($countries as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="rate">Rate</label>
                                <div class="form-control-wrap">
                                    <input name="rate" type="text" class="form-control" id="rate" placeholder="rate">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="default-01">Cost(%)</label>
                                <div class="form-control-wrap">
                                    <input name="cost" type="text" class="form-control" id="default-01" placeholder="cost">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="form-label" for="fixed_amount">Fixed Amount</label>
                                <div class="form-control-wrap">
                                    <input name="fixed_amount" type="text" class="form-control" id="fixed_amount" placeholder="fixed_amount">
                                </div>
                            </div>
                            <div class="form-group col-md-2 mt-4">
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
                            <div class="nk-tb-col"><span class="sub-text">Country</span></div>
                            <div class="nk-tb-col"><span class="sub-text">fixed Amount</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Rate</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Costs</span></div>
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
                                <div class="nk-tb-col">
                                    <span>{{$item->country->name}}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span>{{$item->fixed_amount}}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span>{{$item->rate}}</span>
                                </div>

                                <div class="nk-tb-col">
                                    <span>{{$item->cost}}</span>
                                </div>

                                            <livewire:confirm-remove-rate :rate="$item"/>

                            </div>
                        @endforeach

                    </div><!-- .nk-tb-list -->
                </div>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div>

@endsection
