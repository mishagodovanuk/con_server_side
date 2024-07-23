<?php

namespace App\Enums\Match;

enum ConsolidationStatus: string
{
    case APPROVED = 'approved';

    case UNAPPROVED = 'unapproved';

    case DRAFT = 'draft';

    case SENT = 'sent';

    case REVIEW = 'review';

    case IN_PROGRESS = 'in_progress';

    public function getStatusName()
    {
        return match ($this) {
            ConsolidationStatus::APPROVED => 'Підтверджено',
            ConsolidationStatus::UNAPPROVED => 'Відхилено',
            ConsolidationStatus::DRAFT => 'Чернетка',
            ConsolidationStatus::SENT => 'Відправлено',
            ConsolidationStatus::REVIEW => 'На розгляді',
        };
    }
}
