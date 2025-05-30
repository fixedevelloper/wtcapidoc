@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to WTC Dashboard ADMIN.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                            <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                    </div><!-- .toggle-expand-content -->
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Deposit</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Total Deposited" data-bs-original-title="Total Deposited"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                                                    <span class="amount"> {{number_format($sumDepositTotal,2)}} <span class="currency currency-usd">FCFA</span>
                                                    </span>
                            <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">{{number_format($sumCurrentMonthDeposits,2)}} <span class="currency currency-usd">FCFA</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">{{number_format($sumWeekendDeposits,2)}} <span class="currency currency-usd">FCFA</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalDeposit" style="display: block; box-sizing: border-box; height: 48px; width: 203px;" width="203" height="48"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Transaction</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Total Withdraw" data-bs-original-title="Total Transaction"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                                                    <span class="amount"> {{number_format($sumTotal,2)}} <span class="currency currency-usd">FCFA</span>
                                                    </span>
                            <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">{{number_format($sumCurrentMonthTransactions,2)}} <span class="currency currency-usd">FCFA</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">{{number_format($sumWeekendTransactions,2)}}<span class="currency currency-usd">FCFA</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalWithdraw" style="display: block; box-sizing: border-box; height: 48px; width: 203px;" width="203" height="48"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-4">
                <div class="card card-bordered  card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total withdraws</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Total withdraws" data-bs-original-title="Total withdraws"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                                                    <span class="amount"> {{number_format($sumWithdrawTotal,2)}} <span class="currency currency-usd">FCFA</span>
                                                    </span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">{{number_format($sumCurrentMonthWithdraws,2)}} <span class="currency currency-usd">FCFA</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">{{number_format($sumWeekendWithdraws,2)}} <span class="currency currency-usd">FCFA</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalBalance" style="display: block; box-sizing: border-box; height: 48px; width: 203px;" width="203" height="48"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->


            <div class="col-xl-6 col-xxl-6">
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Transfert</h6>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('admin.transactions')}}" class="link">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Customer</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col"><span>Sender</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Beneficiary</span></div>

                            <div class="nk-tb-col tb-col-sm"><span>&nbsp;Status</span></div>
                            <div class="nk-tb-col"><span>&nbsp;</span></div>
                        </div>
                        @foreach($transactions as $item)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="align-center">
                                <div class="user-card">
                                    <div class="user-avatar user-avatar-xs bg-azure-dim">
                                        <span>{{strtoupper(substr($item['customer']['user']['name'],0,2))}}</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">{{$item['customer']['user']['name']}}</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="tb-sub">{{$item['created_at']}}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">{{number_format($item['amount_total'],2)}} <span>{{$item->gatewayItem->country->currency}}</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <div class="align-center">
                                    <div class="user-avatar user-avatar-sm bg-light">
                                        <span>{{strtoupper(substr($item['sender']['first_name'],0,1))}}{{strtoupper(substr($item['sender']['last_name'],0,1))}}</span>
                                    </div>
                                    <div class="user-name">
                                    <span class="tb-lead">{{$item['sender']['first_name']}} {{$item['sender']['last_name']}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">

                                <div class="user-card">
                                    <div class="user-avatar user-avatar-xs bg-azure-dim">
                                        <span>{{strtoupper(substr($item['beneficiary']['first_name'],0,1))}}{{strtoupper(substr($item['beneficiary']['last_name'],0,1))}}</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">{{$item['beneficiary']['first_name']}} {{$item['beneficiary']['last_name']}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="nk-tb-col tb-col-sm">
                                <span class="{{ $item->stringStatus->class }}">{{$item->stringStatus->value}}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-action">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li><a href="{{route('admin.transaction_detail',['numero_identifiant'=>$item['number_transaction']])}}">View</a></li>
                                            <li><a href="#">Print</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xl-6 col-xxl-6">
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Deposit</h6>
                            </div>
                            <div class="card-tools">
                                <a href="{{route('admin.deposits')}}" class="link">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Customer</span></div>
                            <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>&nbsp;Status</span></div>
                            <div class="nk-tb-col"><span>&nbsp;</span></div>
                        </div>
                        @foreach($deposits as $deposit)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="align-center">
                                    <div class="user-avatar user-avatar-sm bg-light">
                                        <span>P2</span>
                                    </div>
                                    <span class="tb-sub ms-2">
                                        <div class="user-name">
                                        <span class="tb-lead"> {{$deposit->customer->user->name}} </span>
                                    </div>

                                        <span class="d-none d-md-inline">{{$deposit->customer->user->email}}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span class="tb-sub">{{$deposit->created_at}}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">{{$deposit->amount}}<span>FCFA</span></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="{{ $deposit->stringStatus->class }}">{{$deposit->stringStatus->value}}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-action">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li><a href="#">View</a></li>
                                            <li><a href="#">Print</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div>
    </div>
@endsection
