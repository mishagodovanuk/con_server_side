<?php

namespace App\Interfaces;


interface StoreImageInterface
{
    public function setImage($request, $model, $path, $column);

    public function deleteImage($model, $path, $column);
}
