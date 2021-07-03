<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Calendar;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CalendarDayController extends Controller
{
    public function index(Request $request){
        $day = Calendar::where('date',$request->id)->get();
        $items = Schedule::where('user_id',Auth::user()->id)->whereDate('date',$request->id)->get();
        if($items !== null){
            foreach($items as $item){
                $item["start_time"] = substr($item["start_time"], 0, 5); 
                $item["end_time"] = substr($item["end_time"], 0, 5);
                $schedule[] = $item; 
            }
        }
        if(isset($schedule[0])){
            return view('calendar-day.index',['Day'=>$day[0]],['Schedule'=>$schedule]);
            // ↑予定があった場合の処理
        }else{
            return view('calendar-day.index',['Day'=>$day[0]]);
            // ↑予定がなかった場合の処理
        }
        
    }
}
