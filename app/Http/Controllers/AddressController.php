<?php

namespace App\Http\Controllers;

use App\Services\Address\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressController extends Controller
{
    public function __construct(private AddressService $addressService){}

    public function street(){
        return JsonResource::make($this->addressService->getStreets());
    }

    public function settlement(){
        return JsonResource::make($this->addressService->getSettlements());
    }
}
