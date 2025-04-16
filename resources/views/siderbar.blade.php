<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="#" class=" {{request()->routeIs('home')?'active':''}}"><i class="lnr lnr-arrow-right"></i> <span>GET STARTED</span></a></li>
                <li><a href="{{route('countries')}}" class="{{request()->routeIs('countries')?'active':''}}"><i class="lnr lnr-arrow-right"></i> <span>List Countries</span> &nbsp; <span class="label label-success">GET</span></a></li>
                <li><a href="{{route('cities')}}" class="{{request()->routeIs('cities')?'active':''}}"><i class="lnr lnr-arrow-right"></i> <span>List Cities</span> &nbsp; <span class="label label-success">GET</span></a></li>
                <li><a href="{{route('gateway')}}" class="{{request()->routeIs('gateway')?'active':''}}"><i class="lnr lnr-arrow-right"></i> <span>List Gateway</span> &nbsp; <span class="label label-success">GET</span></a></li>
                <li><a href="{{route('operators')}}" class="{{request()->routeIs('operators')?'active':''}}"><i class="lnr lnr-arrow-right"></i> <span>List Operators</span> &nbsp; <span class="label label-success">GET</span></a></li>
                <li>
                    <a href="#sender" data-toggle="collapse" class="collapsed {{request()->routeIs('create_sender')?'active collapsed':''}}"><i class="lnr lnr-arrow-right"></i>
                        <span>Sender</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="sender" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{route('create_sender')}}" class="{{request()->routeIs('create_sender')?'active':''}}">Create &nbsp; <span class="label label-primary">POST</span></a></li>
                            <li><a href="#" class="{{request()->routeIs('operators')?'active':''}}">Details &nbsp; <span class="label label-success">GET</span></a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#beneficiary" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-right"></i> <span>Beneficiary</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="beneficiary" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{route('create_beneficiary')}}" class="{{request()->routeIs('create_beneficiary')?'active':''}}">Create &nbsp; <span class="label label-primary">POST</span></a></li>
                            <li><a href="#" class="{{request()->routeIs('operators')?'active':''}}">Details &nbsp; <span class="label label-success">GET</span></a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-arrow-right"></i> <span>Transfer</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{route('transfert_bank')}}" class="{{request()->routeIs('transfert_bank')?'active':''}}">Bank &nbsp; <span class="label label-primary">POST</span></a></li>
                            <li><a href="{{route('transfert_mobil')}}" class="{{request()->routeIs('transfert_mobil')?'active':''}}">Mobil &nbsp; <span class="label label-primary">POST</span></a></li>
                            <li><a href="#" class="{{request()->routeIs('operators')?'active':''}}">Status  &nbsp; <span class="label label-success">GET</span></a></li>
                            <li><a href="#" class="{{request()->routeIs('operators')?'active':''}}">List &nbsp; <span class="label label-success">GET</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
