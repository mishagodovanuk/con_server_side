<?php

namespace App\Models;

use App\Interfaces\StoreImageInterface;
use App\Traits\AdditionalEquipmentDataTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  AdditionalEquipment extends Model
{
    use HasFactory,SoftDeletes, AdditionalEquipmentDataTrait;

    protected $guarded = [];

    public function getDownloadMethodById($id)
    {
        return TransportDownload::find($id);
    }

    public function downloadMethods()
    {
        $ids = json_decode($this->download_methods);

        return TransportDownload::whereIn('id', $ids)->pluck('name', 'id');
    }

    public function brand()
    {
        return $this->hasOne(AdditionalEquipmentBrand::class, 'id', 'brand_id');
    }

    public function model()
    {
        return $this->hasOne(AdditionalEquipmentModel::class, 'id', 'model_id');
    }

    public function adr()
    {
        return $this->hasOne(Adr::class, 'id', 'adr_id');
    }

    public function type()
    {
        return $this->hasOne(TransportType::class, 'id', 'type_id');
    }

    public function transport()
    {
        return $this->hasOne(Transport::class, 'id', 'transport_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function storeImage($request)
    {
        if ($request->file('image')) {
            $imageService = resolve(StoreImageInterface::class);
            $imageService->setImage($request, $this, 'transport-equipment');
        }
    }

    public static function store($request)
    {
        $equipment = AdditionalEquipment::create([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'type_id' => $request->type,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'transport_id' => $request->transport,
            'download_methods' => $request->download_methods,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'volume' => $request->volume,
            'capacity_eu' => $request->capacity_eu,
            'capacity_am' => $request->capacity_am,
            'adr_id' => $request->adr,
            'carrying_capacity' => $request->carrying_capacity,
            'hydroboard' => $request->hydroboard=='true',
            'workspace_id' => Workspace::current()
        ]);

        $equipment->storeImage($request);
    }

    public function edit($request)
    {
        $this->update([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'type_id' => $request->type,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'transport_id' => $request->transport,
            'download_methods' => $request->download_methods,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'volume' => $request->volume,
            'capacity_eu' => $request->capacity_eu,
            'capacity_am' => $request->capacity_am,
            'adr_id' => $request->adr,
            'carrying_capacity' => $request->carrying_capacity,
            'hydroboard' => $request->hydroboard=='true'
        ]);
        $this->storeImage($request);
    }
}
