<?php

namespace App\Enums\Match;

enum ConsolidationActionType: string
{
    case DOWNLOADING = 'downloading';

    case MOVING = 'moving';

    case UPLOADING = 'unloading';
}
