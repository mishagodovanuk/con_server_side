<?php

namespace App\Enums\Match;

enum ConsolidationType : string
{
 case UPLOADING = 'uploading';

 case COMMON_FTL = 'common_ftl';

 case LARGEST_TRANSPORT = 'lg_transport';

 case REVERSE_UPLOADING = 'reverse_loading';

 public function getTypeName() : string
 {
    return match($this){
        ConsolidationType::UPLOADING => 'Довантаження',
        ConsolidationType::COMMON_FTL => 'Спільний FTL',
        ConsolidationType::LARGEST_TRANSPORT => 'Більший транспорт',
        ConsolidationType::REVERSE_UPLOADING => 'Зворотне завантаження',
    };
 }
}
