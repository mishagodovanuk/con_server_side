<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registers\RegisterRequest;
use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterStatusController extends Controller
{
    public function registerStatus(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['status'] = 'Зареєстровано';
        $data['register'] = Carbon::now()->toDateTimeString();
        $register->updateWithRelations($data);
    }

    public function applyStatus(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['status'] = 'Підтверджено';
        $register->updateWithRelations($data);
    }

    public function launchStatus(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['status'] = 'Запущено';
        $data['entrance'] = Carbon::now()->toDateTimeString();
        $register->updateWithRelations($data);
    }

    public function cancelEntrance(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['status'] = 'Зареєстровано';
        $register->updateWithRelations($data);
    }

    public function releasedStatus(RegisterRequest $request, Register $register)
    {
        $data = $request->validated();
        $data['status'] = 'Поза територією';
        $data['departure'] = Carbon::now()->toDateTimeString();
        $register->updateWithRelations($data);
    }
}
