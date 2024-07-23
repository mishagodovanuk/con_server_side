<?php

namespace App\Http\Controllers;

use App\Models\ExceptionType;
use App\Models\SchedulePattern;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Workspace;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function store(Request $request){
        //check if pattern exist
        if(!SchedulePattern::where('name',$request->name)->first('id'))
        SchedulePattern::create([
            'name'=>$request->name,
            'schedule'=>$request->schedule,
            'type' => $request->type,
            'workspace_id' => Workspace::current()
        ]);
        return response('OK');
    }

    public function editSchedule(User $user)
    {
        $patterns = SchedulePattern::all();
        $exceptions = ExceptionType::all('id', 'name');
        return view('user.update-schedule',compact('user','patterns','exceptions'));
    }

    public function updateSchedule(Request $request, User $user)
    {
        $schedule = json_decode($request->graphic, true);
        $conditions = json_decode($request->conditions, true);

        $user->updateSchedule($schedule);
        $user->updateConditions($conditions);

        return redirect()->back();
    }

    public function updateWarehouseSchedule(Request $request, Warehouse $warehouse){
        $schedule = json_decode($request->graphic, true);
        $conditions = json_decode($request->conditions, true);

        $warehouse->updateSchedule($schedule);
        $warehouse->updateConditions($conditions);
    }
}
