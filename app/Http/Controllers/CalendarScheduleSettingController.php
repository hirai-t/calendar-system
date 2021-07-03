<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Validator;


class CalendarScheduleSettingController extends Controller
{
    public function post(Request $request){
        // バリデーション
        $validate_rule = [
            'title' => 'required',
            'date' => 'required|after_or_equal:2021-01-01|before_or_equal:2050-12-31',
        ];
        $this->validate($request, $validate_rule);
        $schedule = $request->all();
        unset($schedule['_token']);
        Schedule::create($schedule);
        return back();
    }

    public function edit(Request $request){
        $validate_rule = [
            'title' => 'required',
            'date' => 'after_or_equal:2021-01-01|before_or_equal:2050-12-31',
        ];
        $this->validate($request, $validate_rule);
        $schedule = $request->all();
        unset($schedule['_token']);
        $d = $schedule['before_schedule'];
        unset($schedule['before_schedule']);
        Schedule::updateOrCreate(['id'=>$d],$schedule);
        return back();
    }

    public function delete(Request $request){
        $d = $request->id;
        Schedule::where('id',$d)->delete();
        return back();
    }
}
