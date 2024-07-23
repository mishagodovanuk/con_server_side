<?php

namespace App\Models;

use App\Interfaces\StoreImageInterface;
use App\Traits\TransportDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory, SoftDeletes, TransportDataTrait;

    protected $guarded = [];

    public function getDownloadMethodById($id)
    {
        return TransportDownload::find($id);
    }
    public function brand()
    {
        return $this->belongsTo(TransportBrand::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(TransportModel::class, 'model_id');
    }

    public function category()
    {
        return $this->hasOne(TransportCategory::class, 'id', 'category_id');
    }

    public function type()
    {
        return $this->hasOne(TransportType::class, 'id', 'type_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function adr()
    {
        return $this->hasOne(Adr::class, 'id', 'adr_id');
    }

    public function equipment()
    {
        return $this->hasOne(AdditionalEquipment::class, 'id', 'equipment_id');
    }

    public function storeImage($request)
    {
        if ($request->file('image')) {
            $imageService = resolve(StoreImageInterface::class);
            $imageService->setImage($request, $this, 'transport');
        }
    }

    public function updateWithoutTrailer($request)
    {
        $this->update([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'category_id' => $request->category,
            'type_id' => $request->type,
            'weight' => $request->weight,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'registration_country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'driver_id' => $request->driver,
            'spending_empty' => $request->spending_empty,
            'spending_full' => $request->spending_full,
            'equipment_id' => $request->equipment
        ]);

        $this->storeImage($request);
    }

    public function updateWithTrailer($request)
    {
        $this->update([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'category_id' => $request->category,
            'type_id' => $request->type,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'registration_country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'driver_id' => $request->driver,
            'carrying_capacity' => $request->carrying_capacity,
            'hydroboard' => $request->hydroboard=='true',
            'download_methods' => $request->download_methods,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'volume' => $request->volume,
            'weight' => $request->weight,
            'capacity_eu' => $request->capacity_eu,
            'capacity_am' => $request->capacity_am,
            'spending_empty' => $request->spending_empty,
            'spending_full' => $request->spending_full,
            'equipment_id' => $request->equipment,
            'adr_id' => $request->adr
        ]);

        $this->storeImage($request);
    }

    public static function storeWithTrailer($request)
    {
        $transport = Transport::create([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'category_id' => $request->category,
            'type_id' => $request->type,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'registration_country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'driver_id' => $request->driver,
            'carrying_capacity' => $request->carrying_capacity,
            'hydroboard' => $request->hydroboard=='true',
            'download_methods' => $request->download_methods,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'volume' => $request->volume,
            'weight' => $request->weight,
            'capacity_eu' => $request->capacity_eu,
            'capacity_am' => $request->capacity_am,
            'spending_empty' => $request->spending_empty,
            'spending_full' => $request->spending_full,
            'equipment_id' => $request->equimpent,
            'adr_id' => $request->adr,
            'workspace_id' => Workspace::current()
        ]);

        $transport->storeImage($request);
    }

    public static function storeWithoutTrailer($request)
    {

        $transport = Transport::create([
            'brand_id' => $request->mark,
            'model_id' => $request->model,
            'category_id' => $request->category,
            'type_id' => $request->type,
            'weight' => $request->weight,
            'license_plate' => $request->license_plate ?? $request->license_plate_without_mask,
            'registration_country_id' => $request->registration_country,
            'manufacture_year' => $request->manufacture_year,
            'company_id' => $request->company,
            'driver_id' => $request->driver,
            'spending_empty' => $request->spending_empty,
            'spending_full' => $request->spending_full,
            'equipment_id' => $request->equipment,
            'workspace_id' => Workspace::current()
        ]);

        $transport->storeImage($request);
    }
}
