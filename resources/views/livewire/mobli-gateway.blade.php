<div>

<div class="row gy-4 mb-3">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="custom-control custom-control-lg custom-switch">
                <input wire:model.live="activate" @if($activate==1) value="1" checked="" @else value="0"   @endif type="checkbox"
                       wire:change="activateUpdate"
                       class="custom-control-input" id="customSwitch2">
                <label class="custom-control-label" for="customSwitch2">Active</label>
            </div>
        </div>
    </div>

</div>
<div class="row gy-4">
    <div class="col-md-6">
        <div class="nk-block">

            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title title">Gateway Mobil</h5>
                    <p></p>
                </div>
            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="row gy-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Flutterwave</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model.live="gatewaymobil" value="FLUTTERWAVE" wire:change="selectedGatewaymobil" name="gateway_mobil" type="radio" class="custom-control-input"
                                           id="Flutterwave">
                                    <label class="custom-control-label" for="Flutterwave">Flutterwave</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Agensic Pay</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model.live="gatewaymobil" value="AGENSICPAY" wire:change="selectedGatewaymobil" name="gateway_mobil" type="radio" class="custom-control-input"
                                           id="Agensicpay">
                                    <label class="custom-control-label" for="Agensicpay">Agensicpay</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Paydunya</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="gatewaymobil" value="PAYDUNYA" name="gateway_mobil" wire:change="selectedGatewaymobil" type="radio" class="custom-control-input" id="Paydunya">
                                    <label class="custom-control-label" for="Paydunya">Paydunya</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Wacepay</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model="gatewaymobil" value="WACEPAY" name="gateway_mobil" type="radio" wire:change="selectedGatewaymobil"
                                           class="custom-control-input" id="Wacepay">
                                    <label class="custom-control-label" for="Wacepay">Wacepay</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-inner">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Payercode</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gatewayArrayMobils as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['code']}}</td>
                                <td>{{$item['payer_code']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary" wire:click="saveGatewaymobil"> Save</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nk-block">

            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title title">Gateway Bank</h5>
                    <p></p>
                </div>
            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="row gy-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Flutterwave</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model.live="gatewaybank" value="FLUTTERWAVE" wire:change="selectedGatewaybank" name="gateway_bank"
                                           type="radio" class="custom-control-input"
                                           id="Flutterwavebank">
                                    <label class="custom-control-label" for="Flutterwavebank">Flutterwave</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="preview-block">
                                <span class="preview-title overline-title">Wacepay</span>
                                <div class="custom-control custom-checkbox">
                                    <input wire:model.live="gatewaybank" value="WACEPAY" wire:change="selectedGatewaybank" name="gateway_bank"
                                           type="radio" class="custom-control-input"
                                           id="Wacepaybank">
                                    <label class="custom-control-label" for="Wacepaybank">Wacepay</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-inner">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Payercode</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gatewayArrayBanks as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['code']}}</td>
                                <td>{{$item['payer_code']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-outline-dark" wire:click="saveGatewaybank"> Save</button>
            </div>
        </div>
    </div>
</div>
</div>
