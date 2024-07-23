<?php

namespace App\Models;

use App\Interfaces\StoreFileInterface;
use App\Traits\CompanyDataTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory, SoftDeletes, CompanyDataTrait;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            $file = resolve(StoreFileInterface::class);
            $file->deleteFile('company/image', $company, 'img_type');
            UserWorkingData::where('company_id', $company->id)->delete();
            if ($company->company_type_id == 1) {
                PhysicalCompany::find($company->company_id)->delete();
            } else {
                $companyType = LegalCompany::find($company->company_id);
                $file->deleteFile('company/docs/install', $companyType, 'install_doctype',);
                $file->deleteFile('company/docs/registration', $companyType, 'reg_doctype',);
                $companyType->delete();
            }
        });
    }

    public function company()
    {
        return $this->morphTo();
    }

    public function address()
    {
        return $this->hasOne(AddressDetails::class, 'id', 'address_id');
    }

    public function type()
    {
        return $this->hasOne(CompanyType::class, 'id', 'company_type_id');
    }

    public function workspace()
    {
        return $this->hasOne(Workspace::class, 'id', 'workspace_id');
    }

    public function companiesInWorkspace()
    {
        return $this->belongsToMany(Workspace::class, 'company_to_workspaces');
    }

    public function requests()
    {
        return $this->hasMany(CompanyRequest::class, 'company_id', 'id');
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            UserWorkingData::class,
            'company_id',
            'id',
            'id',
            'user_id'
        );
    }

    public function getName()
    {
        return $this->company_type_id == 1 ? $this->company->surname
            . ' ' . mb_substr($this->company->first_name, 0, 1) . '.' . mb_substr($this->company->patronymic, 0, 1)
            : $this->company->name;
    }

    public static function createPhysical($request)
    {
        $file = resolve(StoreFileInterface::class);

        $address = AddressDetails::create(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->city,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
                'apartment_number' => $request->flat,
                'gln' => $request->gln,
            ]
        );

        $physicalCompany = PhysicalCompany::create([
            "first_name" => $request->firstName,
            "surname" => $request->lastName,
            "patronymic" => $request->patronymic
        ]);

        $company = parent::create([
            'email' => $request->email,
            'company_type' => 'App\Models\PhysicalCompany',
            'company_id' => $physicalCompany->id,
            'company_type_id' => (CompanyType::where('key', 'physical')->first('id'))->id,
            'ipn' => $request->ipn,
            'address_id' => $address->id,
            'bank' => $request->bank,
            'iban' => $request->iban,
            'mfo' => $request->mfo,
            'about' => $request->about,
            'currency' => $request->currency,
            'creator_id' => $request->has_creator == 'true' ? Auth::id() : null,
        ]);

        if (property_exists($request, 'has_creator') || !empty(Workspace::current())) {
            CompanyToWorkspace::create([
                'company_id' => $company->id,
                'workspace_id' => Workspace::current()
            ]);
        }


        $file->setFile($request->file('image'), 'company/image', $company, 'img_type');

        return $company;
    }

    public static function createLegal($request)
    {
        $file = resolve(StoreFileInterface::class);

        $address = AddressDetails::create(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->city,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
                'apartment_number' => $request->flat,
                'gln' => $request->gln,
            ]
        );

        $legalAddress = AddressDetails::create(
            [
                'country_id' => $request->u_country,
                'settlement_id' => $request->u_city,
                'street_id' => $request->u_street,
                'building_number' => $request->u_building_number,
                'apartment_number' => $request->u_flat,
                'gln' => $request->u_gln,
            ]
        );

        $legalCompany = LegalCompany::create([
            "name" => $request->company_name,
            "edrpou" => $request->edrpou,
            "legal_type_id" => $request->legal_entity,
            "legal_address_id" => $legalAddress->id,
        ]);

        $company = parent::create([
            'email' => $request->email,
            'company_type' => 'App\Models\LegalCompany',
            'company_id' => $legalCompany->id,
            'company_type_id' => (CompanyType::where('key', 'legal')->first('id'))->id,
            'ipn' => $request->ipn,
            'address_id' => $address->id,
            'bank' => $request->bank,
            'iban' => $request->iban,
            'mfo' => $request->mfo,
            'about' => $request->about,
            'currency' => $request->currency,
            'creator_id' => $request->has_creator == 'true' ? Auth::id() : null,
        ]);

        if ($request->has_creator == 'true') {
            $userWorkingData = UserWorkingData::create([
                'user_id' => Auth::id(),
                'company_id' => $company->id,
                'workspace_id' => !empty(Workspace::current()) ? Workspace::current() : null
            ]);

            $userWorkingData->assignRole('admin');

        }

        if (property_exists($request, 'has_creator') || !empty(Workspace::current())) {
            CompanyToWorkspace::create([
                'company_id' => $company->id,
                'workspace_id' => Workspace::current()
            ]);
        }

        $file->setFile($request->file('image'), 'company/image', $company, 'img_type');
        //find file by legal company id
        if ($request->file('registration_doc') && $request->file('ust_doc')) {
            $file->setFile($request->file('registration_doc'), 'company/docs/registration', $legalCompany, 'reg_doctype');
            $file->setFile($request->file('ust_doc'), 'company/docs/install', $legalCompany, 'install_doctype');
        }

        return $company;
    }

    public function updatePhysical($request)
    {

        AddressDetails::find($this->address_id)->update(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->city,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
                'apartment_number' => $request->flat,
                'gln' => $request->gln,
            ]
        );

        PhysicalCompany::find($this->company_id)->update([
            "first_name" => $request->firstName,
            "surname" => $request->lastName,
            "patronymic" => $request->patronymic
        ]);

        $this->update([
            'email' => $request->email,
            'ipn' => $request->ipn,
            'bank' => $request->bank,
            'iban' => $request->iban,
            'mfo' => $request->mfo,
            'about' => $request->about,
            'currency' => $request->currency
        ]);

        if ($request->file('image')) {
            $file = resolve(StoreFileInterface::class);
            $file->setFile($request->file('image'), 'company/image', $this, 'img_type');
        }
    }

    public function updateLegal($request)
    {
        $legalCompany = LegalCompany::find($this->company_id);
        $legalCompany->update([
            "name" => $request->company_name,
            "edrpou" => $request->edrpou,
        ]);

        AddressDetails::find($this->address_id)->update(
            [
                'country_id' => $request->country,
                'settlement_id' => $request->city,
                'street_id' => $request->street,
                'building_number' => $request->building_number,
                'apartment_number' => $request->flat,
                'gln' => $request->gln,
            ]
        );

        AddressDetails::find($legalCompany->legal_address_id)->update(
            [
                'country_id' => $request->u_country,
                'settlement_id' => $request->u_city,
                'street_id' => $request->u_street,
                'building_number' => $request->u_building_number,
                'apartment_number' => $request->u_flat,
                'gln' => $request->u_gln,
            ]
        );

        $this->update([
            'email' => $request->email,
            'ipn' => $request->ipn,
            'bank' => $request->bank,
            'iban' => $request->iban,
            'mfo' => $request->mfo,
            'about' => $request->about,
            'currency' => $request->currency
        ]);

        if ($request->file('image')) {
            $file = resolve(StoreFileInterface::class);
            $file->setFile($request->file('image'), 'company/image', $this, 'img_type');
        }
    }
}
