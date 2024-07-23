<?php

namespace App\Interfaces;

interface StoreFileInterface
{
    public function setFile($file, $pathName, $model, $fieldName, $modelId = null);

    public function deleteFile($pathName, $model, $fieldName, $modelId = null);
}
