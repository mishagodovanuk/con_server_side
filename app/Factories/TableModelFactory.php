<?php

namespace App\Factories;

use App\Models\AdditionalEquipment;
use App\Models\Company;
use App\Models\ContainerByDocument;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\ServiceByDocument;
use App\Models\SKU;
use App\Models\SkuByDocument;
use App\Models\Transport;
use App\Models\User;
use App\Models\Warehouse;

class TableModelFactory
{
    public function user(): User
    {
        return new User();
    }

    public function additionalEquipment(): AdditionalEquipment
    {
        return new AdditionalEquipment();
    }

    public function company(): Company
    {
        return new Company();
    }

    public function transport(): Transport
    {
        return new Transport();
    }

    public function warehouse(): Warehouse
    {
        return new Warehouse();
    }

    public function sku(): SKU
    {
        return new SKU();
    }

    public function document(): Document
    {
        return new Document();
    }

    public function document_type(): DocumentType
    {
        return new DocumentType();
    }

    public function sku_by_document(): SkuByDocument
    {
        return new SkuByDocument();
    }

    public function container_by_document(): ContainerByDocument
    {
        return new ContainerByDocument();
    }

    public function service_by_document(): ServiceByDocument
    {
        return new ServiceByDocument();
    }
}
