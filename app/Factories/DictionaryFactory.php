<?php

namespace App\Factories;

use App\Enums\Currency;
use App\Models\AdditionalEquipment;
use App\Models\AdditionalEquipmentBrand;
use App\Models\AdditionalEquipmentModel;
use App\Models\AdditionalEquipmentType;
use App\Models\Adr;
use App\Models\Brigade;
use App\Models\CargoType;
use App\Models\CellStatus;
use App\Models\CellType;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\CompanyStatus;
use App\Models\ContainerType;
use App\Models\Country;
use App\Models\Document;
use App\Models\DownloadZone;
use App\Models\LegalType;
use App\Models\MeasurementUnit;
use App\Models\PackageType;
use App\Models\Position;
use App\Models\ServiceCategories;
use App\Models\Settlement;
use App\Models\SKUCategory;
use App\Models\StorageType;
use App\Models\Street;
use App\Models\Transport;
use App\Models\TransportBrand;
use App\Models\TransportDownload;
use App\Models\TransportCategory;
use App\Models\TransportModel;
use App\Models\TransportType;
use App\Models\Unit;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseERP;
use App\Models\WarehouseType;
use App\Models\Workspace;
use Illuminate\Support\Facades\DB;

class DictionaryFactory
{
    public static function adr()
    {
        return new Adr();
    }

    public static function cell_type()
    {
        return new CellType();
    }

    public static function cell_status()
    {
        return new CellStatus();
    }

    public static function company_status()
    {
        return new CompanyStatus();
    }

    public static function country()
    {
        return new Country();
    }

    public static function download_zone()
    {
        return new DownloadZone();
    }

    public static function measurement_unit()
    {
        return new MeasurementUnit();
    }

    public static function package_type()
    {
        return new PackageType();
    }

    public static function position()
    {
        return new Position();
    }

    public static function settlement(bool $inTable)
    {
        if ($inTable) {
            return new Settlement();
        }
        return null;
    }

    public static function street(bool $inTable)
    {
        if ($inTable) {
            return new Street();
        }
        return null;
    }

    public static function storage_type()
    {
        return new StorageType();
    }

    public static function transport_brand()
    {
        return new TransportBrand();
    }

    public static function transport_download()
    {
        return new TransportDownload();
    }

    public static function transport_kind()
    {
        return new TransportCategory();
    }

    public static function transport_type()
    {
        return new TransportType();
    }

    public static function warehouse_type()
    {
        return new WarehouseType();
    }

    public static function company()
    {
        return (new Company())->select(['companies.id'])->filterByWorkspace()->addName();
    }

    public static function warehouse()
    {
        return (new Warehouse())->where('workspace_id', Workspace::current())->select(['id', 'name']);
    }

    public static function transport()
    {
        return (new Transport())->where('workspace_id', Workspace::current())
            ->select(['transports.id'])
            ->addFullName();
    }

    public static function additional_equipment()
    {
        return (new AdditionalEquipment())->where('workspace_id', Workspace::current())
            ->select(['additional_equipment.id'])
            ->addFullName();
    }

    public static function user()
    {
        return (new User())->filterByWorkspace()->select(DB::raw('CONCAT(name, " ", surname) AS name'),'users.id');
    }

    public static function document_order()
    {
        return (new Document())->whereHas('documentType', function ($q) {
            $q->where('key', 'zamovlennia');
        })->select('id', DB::raw("CONCAT('№ ', documents.id) as name"));
    }

    public static function document_goods_invoice()
    {
        return (new Document())->whereHas('documentType', function ($q) {
            $q->where('key', 'tovarna_nakladna');
        })->where('workspace_id',Workspace::current())
            ->select('id', DB::raw("CONCAT('№ ', documents.id) as name"));
    }

    public static function currencies()
    {
        return array_map(function ($item) {
            return [
                'id' => $item->value,
                'name' => $item->name
            ];
        }, Currency::cases());
    }

    public static function driver()
    {
        return User::withWorkingData()
            ->where('user_working_data.workspace_id', Workspace::current())
            ->whereHas('workingData.position', function ($query) {
                $query->where('key', 'driver');
            })->select(DB::raw('CONCAT(name, " ", surname) AS name'),'users.id');

    }

    public static function legal_type()
    {
        return (new LegalType());
    }

    public static function warehouse_erp()
    {
        return (new WarehouseERP());
    }

    public static function transport_model()
    {
        return (new TransportModel());
    }


    public static function additional_equipment_model()
    {
        return (new AdditionalEquipmentModel());
    }

    public static function additional_equipment_brand()
    {
        return (new AdditionalEquipmentBrand());
    }

    public static function additional_equipment_type()
    {
        return (new AdditionalEquipmentType());
    }


    public static function container_type()
    {
        return (new ContainerType());
    }

    public static function service_category()
    {
        return (new ServiceCategories());
    }

    public static function goods_category()
    {
        return (new SKUCategory());
    }

    public static function company_category()
    {
        return (new CompanyCategory());
    }

    public static function cargo_type()
    {
        return new CargoType();
    }

    public static function delivery_type()
    {
       // return new CargoType();
    }

    public static function basis_for_ttn(){
        return [
           ['id'=>1,'key'=>'tn','name' => 'ТТ'],
            ['id'=>2,'key'=>'transport_request', 'name' =>'Запит на транспорт']
        ];
    }

    public static function document_tn(){
        return (new Document())->whereHas('documentType', function ($q) {
            $q->where('key', 'tovarna_nakladna');
        })->where('workspace_id',Workspace::current())
            ->select('id', DB::raw("CONCAT(documents.id) as name"));
    }

    public static function document_transport_request(){
        return (new Document())->whereHas('documentType', function ($q) {
            $q->where('key', 'zapyt_na_transport');
        })->where('workspace_id',Workspace::current())
            ->select('id', DB::raw("CONCAT(documents.id) as name"));
    }

}
