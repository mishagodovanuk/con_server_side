<?php

namespace App\Http\Controllers;

use App\Http\Requests\Goods\CreateUpdateGoodsRequest;
use App\Models\Adr;
use App\Models\Company;
use App\Models\Country;
use App\Models\Goods;
use App\Models\MeasurementUnit;
use App\Models\PackageType;
use App\Models\SKUCategory;
use App\Models\Workspace;
use App\Services\Goods\TableFacade;
use App\Services\GoodsPackage\TableFacade as PackageTable;
use App\Services\GoodsBarcode\TableFacade as BarcodeTable;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodsController extends Controller
{
    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function packageFilter(Goods $sku)
    {
        return PackageTable::getFilteredData($sku->id);
    }

    public function barcodeFilter(Goods $sku)
    {
        return BarcodeTable::getFilteredData($sku->id);
    }

    public function store(CreateUpdateGoodsRequest $request)
    {
        $goodsId = Goods::store($request);

        return response()->json(['goods_id' => $goodsId]);
    }

    public function update(CreateUpdateGoodsRequest $request, Goods $sku)
    {
        $goodsId = $sku->updateData($request);

        return response()->json(['goods_id' => $goodsId]);
    }

    public function show(Goods $sku)
    {
        $sku->load([
            'company' => function ($q) {
                $q->select('companies.*')->addName();
            },
            'category',
            'manufacturer' => function ($q) {
                $q->select('companies.*')->addName();
            },
            'manufacturer_country',
            'adr',
            'measurement_unit',
        ]);

        return view('sku.full-info', compact('sku'));
    }

    public function edit(Goods $sku)
    {
        $categories = SKUCategory::all();
        $measurementUnits = MeasurementUnit::all();
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })
            ->orWhere('workspace_id', Workspace::current())
            ->select(['companies.*'])
            ->addName()
            ->get();
        $adrs = Adr::all();
        $countries = Country::all();
        $packageTypes = PackageType::all();

        return view('sku.edit', compact(
            'categories', 'measurementUnits', 'companies', 'adrs', 'countries', 'packageTypes', 'sku'
        ));
    }

    public function create()
    {
        $categories = SKUCategory::all();
        $measurementUnits = MeasurementUnit::all();
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $adr = Adr::all();
        $countries = Country::all();
        $packageTypes = PackageType::all();
        return view('sku.create', compact(
            'categories', 'measurementUnits', 'companies', 'adr', 'countries', 'packageTypes'
        ));
    }

    public function index()
    {
        $goods = Goods::all();
        return view('sku.index', compact('goods'));
    }

    public function getSkuByCategory($id)
    {
        $sku = Goods::where('category_id', $id)->get();

        return JsonResource::collection($sku);
    }

    public function getAllData(Goods $sku)
    {
        return response()->json($sku->getAllData());
    }
}
