@extends('sandbox.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard - Solde {{number_format($customer->balance)}} XAF</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total transaction</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{number_format($sumTotal,2)}} FCFA</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayOrders" style="display: block; box-sizing: border-box; height: 40px; width: 100px;" width="100" height="40"></canvas>
                                    </div>
                                </div>
                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Month Transactions</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{number_format($sumCurrentMonthTransactions,2)}} FCFA</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue" style="display: block; box-sizing: border-box; height: 40px; width: 100px;" width="100" height="40"></canvas>
                                    </div>
                                </div>
                                <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>4.02%</span><span> vs. last month</span></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Week Transactions</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{number_format($sumWeekendTransactions,2)}} FCFA</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue" style="display: block; box-sizing: border-box; height: 40px; width: 100px;" width="100" height="40"></canvas>
                                    </div>
                                </div>
                                <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>2.34%</span><span> vs. last week</span></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Deposit</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">{{number_format($sumDepositTotal,2)}} FCFA</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayCustomers" style="display: block; box-sizing: border-box; height: 40px; width: 100px;" width="100" height="40"></canvas>
                                    </div>
                                </div>
                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-xxl-8">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent transactions</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>No.</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Sender</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Beneficiary</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                        </div>
                        @foreach($last_transactions as $item)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">#{{$item['code']}}</a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar sm bg-purple-dim">
                                            <span>{{ substr($item['sender']['first_name'],0,1) }}{{ substr($item['sender']['last_name'],0,1) }}</span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead">{{$item['sender']['first_name']}} {{$item['sender']['last_name']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar sm bg-gray-dim">
                                            <span>{{ substr($item['beneficiary']['first_name'],0,1) }}{{ substr($item['beneficiary']['last_name'],0,1) }}</span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead">{{$item['beneficiary']['first_name']}} {{$item['beneficiary']['last_name']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{$item['created_at']}}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount">{{number_format($item['amount_total'],2)}} <span>{{$item->gatewayItem->country->currency}}</span></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-dot badge-dot-xs {{ $item->stringStatus->class }}">{{$item->stringStatus->value}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!-- .card -->
            </div>
        </div><!-- .row -->
    </div>
@endsection
