<?php

namespace App\Interfaces;


interface AvatarInterface
{
    public function setAvatar($request,$user);

    public function deleteAvatarIfExist($user);
}
