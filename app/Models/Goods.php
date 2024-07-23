<?php

namespace App\Models;

use App\Traits\GoodsDataTrait;
use App\Traits\HasWorkspace;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    use HasWorkspace, SoftDeletes;

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SKUCategory::class, 'category_id');
    }

    public function cargo_type(): BelongsTo
    {
        return $this->belongsTo(CargoType::class, 'cargo_type_id');
    }
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'manufacturer_id');
    }

    public function manufacturer_country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'manufacturer_country_id');
    }

    public function adr(): BelongsTo
    {
        return $this->belongsTo(Adr::class, 'adr_id');
    }

    public function measurement_unit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_unit_id');
    }

    public function barcodes(): HasMany
    {
        return $this->hasMany(Barcode::class, 'goods_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'goods_id');
    }

    public function leftovers(): hasMany
    {
        return $this->hasMany(Leftover::class, 'goods_id');
    }

    //TODO leftovers
    public function getAllData() : array{
        $dataArray = [];
        $dataArray['name'] = $this->name;
        $dataArray['height'] = $this->height;
        $dataArray['width'] = $this->width;
        $dataArray['length'] = $this->depth;
        $dataArray['weight_netto'] = $this->weight_netto;
        $dataArray['weight_brutto'] = $this->weight_brutto;
        $dataArray['temperature'] = $this->temp_from && $this->temp_to ? $this->temp_from.'-'.$this->temp_to : '';
        $dataArray['wms_leftovers'] = $this->leftovers->sum('count');
        $dataArray['erp_leftovers'] = 4321;
        $dataArray['measurement_unit'] = $this->measurement_unit->name;
        $dataArray['consignment'] = $this->party;
        $dataArray['consignments'] = $this->leftovers()->groupBy('consignment')
            ->get(['consignment', DB::raw('SUM(count) as count')])
            ->filter(function ($item) {
                return $item->count > 0;
            })->pluck('consignment');
        return $dataArray;
    }

    public static function store($request)
    {
        $goodsData = $request->except(['_token', 'barcodes', 'packages']);

        $goodsData['workspace_id'] = $request->user()->current_workspace_id;

        $goods = new Goods();
        $goods->fill($goodsData);
        $goods->save();

        if ($packages = $request->get('packages')) {
            $newPackages = array_map(function ($item) use ($goods) {
                $item['goods_id'] = $goods->id;
                $item['created_at'] = Carbon::now();
                $item['updated_at'] = Carbon::now();
                $item['is_default'] = boolval($item['packingSetMain']);

                unset($item['packingSetMain']);

                return $item;
            }, $packages);

            Package::insert($newPackages);
        }

        if ($barcodes = $request->get('barcodes')) {
            $newBarcodes = array_map(function ($item) use ($goods) {
                return [
                    'barcode' => $item,
                    'goods_id' => $goods->id,
                    'user_id' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }, $barcodes);

            Barcode::insert($newBarcodes);
        }

        return $goods->id;
    }


    public function updateData($request)
    {
        $goodsData = $request->except(['_token', 'barcodes', 'packages', '_method']);

        $this->fill($goodsData);
        $this->save();

        if ($packages = $request->get('packages')) {
            $ids = [];
            $insert = [];

            foreach ($packages as $package)
            {
                $package['is_default'] = boolval($package['packingSetMain']);
                unset($package['packingSetMain']);

                if (isset($package['id'])) {
                    $ids[] = $package['id'];

                    Package::where('id', $package['id'])->update($package);
                } else {
                    $package['goods_id'] = $this->id;
                    $package['created_at'] = Carbon::now();
                    $package['updated_at'] = Carbon::now();

                    $insert[] = $package;
                }
            }

            Package::whereNotIn('id', $ids)->delete();
            Package::insert($insert);
        }

        if ($barcodes = $request->get('barcodes')) {
            $ids = [];
            $insert = [];

            foreach ($barcodes as $barcode)
            {
                if (is_array($barcode)) {
                    $ids[] = $barcode['id'];

                    Barcode::where('id', $barcode['id'])->update($barcode);
                } else {
                    $newBarcode = [
                        'barcode' => $barcode,
                        'goods_id' => $this->id,
                        'user_id' => Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];

                    $insert[] = $newBarcode;
                }
            }

            Barcode::whereNotIn('id', $ids)->delete();
            Barcode::insert($insert);
        }

        return $this->id;
    }
}
