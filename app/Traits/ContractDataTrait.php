<?php

namespace App\Traits;

use App\Enums\ContractRole;
use App\Enums\ContractStatus;
use App\Enums\ContractType;
use Illuminate\Support\Facades\Auth;

trait ContractDataTrait
{
    public $typePallets = [
        'evropaleta_120h80sm' => 'Європалета 120х80см',
        "amerikans'ka_paleta_120h100sm" => 'Американська палета 120х100см',
        'napivpaleta_60h80sm' => 'Напівпалета 60х80см',
        "fins'ka_paleta" => 'Фінська палета',
    ];

    public function getSideName($contract)
    {
        if ($contract->workspace_id === Auth::user()->current_workspace_id) {
            return 'Вихідний';
        } else {
            return 'Вхідний';
        }
    }

    public function getTypeName($contract)
    {
        switch ($contract->type_id) {
            case ContractType::TRADE_SERVICE:
                return 'Договір на торгові послуги';
            case ContractType::WAREHOUSE_SERVICE:
                return 'Договір на складські послуги';
            case ContractType::TRANSPORT_SERVICE:
                return 'Договір на транспортні послуги';
            default:
                return '';
        }
    }

    public function getStatusName($contract)
    {
        switch ($contract->status) {
            case ContractStatus::CREATED:
                return 'Створено';
            case ContractStatus::PENDING_CONSOLIDATION:
                if ($contract->workspace_id === Auth::user()->current_workspace_id) {
                    return 'Надіслано на розгляд';
                } else {
                    return 'Очікує на розгляд';
                }
            case ContractStatus::PENDING_SIGN:
                return 'Очікує на підпис';
            case ContractStatus::SIGNED_ALL:
                return 'Підписано всіма';
            case ContractStatus::TERMINATED:
                return 'Розірвано';
            case ContractStatus::DECLINE:
                return 'Відхилено';
            case ContractStatus::DECLINE_CONTRACTOR:
                return 'Відхилено контрагентом';
            default:
                return '';
        }
    }

    public function getRoleName($contract)
    {
        switch ($contract->role) {
            case ContractRole::CUSTOMER->value:
                return 'Замовник';
            case ContractRole::PROVIDER->value:
                return 'Постачальник';
            default:
                return '';
        }
    }

    public function getSide($contract)
    {
        return $contract->workspace_id === Auth::user()->current_workspace_id;
    }

    public function translitPaletName($settings)
    {
        $settings['typePalet'] = $this->typePallets[$settings['typePalet']];

        return $settings;
    }
}
