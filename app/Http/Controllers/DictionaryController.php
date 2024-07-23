<?php

namespace App\Http\Controllers;

use App\Factories\DictionaryFactory;
use App\Services\Company\CompanyDictionaryService;
use App\Services\Dictionary\DictionaryService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DictionaryController extends Controller
{

    public function getCompanyList()
    {
        return JsonResource::make((new CompanyDictionaryService)->getDictionaryList());
    }

    public function getDictionaryList($dictionary): JsonResource
    {
        return JsonResource::make((new DictionaryService)->getDictionaryList($dictionary));
    }
}
