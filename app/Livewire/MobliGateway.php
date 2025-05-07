<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Gateway;
use Livewire\Component;

class MobliGateway extends Component
{

    public $gatewaymobil;
    public $activate;
    public $gatewaybank;
    public $country;
    public $gatewayArrayMobils=[];
    public $gatewayArrayBanks=[];
    public function selectedGatewaymobil()
    {
        $this->gatewayArrayMobils=Gateway::query()->where(['method'=>$this->gatewaymobil,'type'=>Helper::METHODMOBIL,'country_id'=>$this->country->id])->get();
    }
    public function selectedGatewaybank()
    {
        $this->gatewayArrayBanks=Gateway::query()->where(['method'=>$this->gatewaybank,
            'type'=>Helper::METHODBANK,'country_id'=>$this->country->id])->get();
    }
    public function mount($country)
    {
        $this->activate=$country->active;
        $this->gatewaymobil=$country->code_gateway_mobil;
        $this->gatewaybank=$country->code_gateway_bank;
        $this->gatewayArrayMobils=Gateway::query()->where(['method'=>$this->gatewaymobil,'type'=>Helper::METHODMOBIL,'country_id'=>$this->country->id])->get();
        $this->gatewayArrayBanks=Gateway::query()->where(['method'=>$this->gatewaybank,'type'=>Helper::METHODBANK,'country_id'=>$this->country->id])->get();

    }
    public function activateUpdate(){
        logger($this->activate);
        $this->country->active=$this->activate==1?1:0;
        $this->country->update();
    }
    public function saveGatewaymobil()
    {
        $this->country->code_gateway_mobil=$this->gatewaymobil;
        $this->country->update();
        notify('Just a heads-up.', 'info');
    }
    public function saveGatewaybank()
    {
        $this->country->code_gateway_bank=$this->gatewaybank;
        $this->country->update();
        notify('Just a heads-up.', 'info');
    }
    public function render()
    {
        return view('livewire.mobli-gateway');
    }
}
