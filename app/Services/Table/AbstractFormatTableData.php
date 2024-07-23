<?php

namespace App\Services\Table;

abstract class AbstractFormatTableData
{
    abstract function formatData($model);

    public function renameFields($fieldName)
    {
        return $fieldName;
    }

    public function relationsByField($fieldName)
    {
        return $fieldName;
    }

    public function relationsSelectByField($relationName)
    {
        return 'name';
    }

    public function joinsByField($fieldName, $model)
    {
        return $model;
    }
}
