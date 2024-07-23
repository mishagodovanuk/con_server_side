<?php

namespace App\Http\Controllers;

use App\Http\Requests\SKU\BarcodeRequest;
use App\Http\Requests\SKU\PackageRequest;
use App\Models\Barcode;
use App\Models\Package;
use Illuminate\Http\Request;

class SKUPackageController extends Controller
{
    public function create(PackageRequest $request)
    {
        Package::create($request->validated());

        return redirect()->back();
    }

    public function update(PackageRequest $request, Package $package)
    {
        $package->update($request->all());

        return redirect()->back();
    }

    public function delete(Package $package)
    {
        $package->delete();

        return redirect()->back();
    }

    public function createBarcode(BarcodeRequest $request)
    {
        Barcode::create($request->all());

        return redirect()->back();
    }

    public function updateBarcode(BarcodeRequest $request, Barcode $barcode)
    {
        $barcode->update($request->all());

        return redirect()->back();
    }

    public function deleteBarcode(Barcode $barcode)
    {
        $barcode->delete();

        return redirect()->back();
    }
}
