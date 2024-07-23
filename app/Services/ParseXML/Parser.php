<?php

namespace App\Services\ParseXML;

use App\Models\AddressDetails;
use App\Models\Company;
use App\Models\CompanyType;
use App\Models\Country;
use App\Models\LegalCompany;
use App\Models\PhysicalCompany;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;


class Parser
{
    private $url;

    private $contragentImporter, $locationImportrer, $skuImporter, $leftoversImporter;

    public function __construct()
    {
        $this->url = 'ftp://' . config('ftp.login') . ':' . config('ftp.password') . '@' . config('ftp.server');

         $this->contragentImporter = new ContragentsImporter();
//         $this->locationImportrer = new LocationsImporter();
//          $this->skuImporter = new SKUImporter();
//        $this->leftoversImporter = new LeftoversImporter();
    }

    public function updateDB()
    {
        $start = microtime(true);
        $this->contragentImporter->import($this->url);
//        Log::info('PARSED Contr');
//        $this->locationImportrer->import($this->url);
//        Log::info('PARSED Location');
//        $this->skuImporter->import($this->url);
//        Log::info('PARSED SKU');
//        $this->leftoversImporter->import($this->url);
        $end = microtime(true);
        Log::info('PARSED Leftovers');
        Log::info('PARSE TIME:' . $end - $start);

        return 'OK';
    }

}
