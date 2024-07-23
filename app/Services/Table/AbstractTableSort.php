<?php

namespace App\Services\Table;


abstract class AbstractTableSort
{
    public function __construct(protected AbstractFormatTableData $formatTableData){}

    abstract function getSortedData($model);

    public function existsInFilter($fieldName)
    {
        if (isset($_GET['filterscount'])) {
            $filtersCount = $_GET['filterscount'];
            if ($filtersCount > 0) {
                for ($i = 0; $i < $filtersCount; $i++) {
                    if ($_GET["filterdatafield" . $i] === $fieldName) return true;
                }
            }
        }

        return false;
    }
}
