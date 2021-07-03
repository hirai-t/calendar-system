<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Calendar;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CalendarMonthController extends Controller
{
    public function index(Request $request){
        $replace = substr_replace($request->id, '01', 8);
        $dt = new Carbon($replace);
        $dt->dayOfWeekIso;
        $startDay = $dt->copy()->subDay($dt->dayOfWeekIso - 1)->format('Y-m-d');
        $Data = Calendar::where('date' , '>=' , $startDay)->limit(42)->get();
        foreach($Data as $day){
            if (Schedule::where('user_id',Auth::user()->id)->where('date', '=', $day->date)->exists()) {
                $items = Schedule::where('user_id',Auth::user()->id)->whereDate('date',$day->date)->get();
                foreach($items as $i){
                    $i["start_time"] = substr($i["start_time"], 0, 5); 
                    $i["end_time"] = substr($i["end_time"], 0, 5);
                    $item[] = $i; 
                }
                array_multisort( array_map( "strtotime", array_column( $item, "start_time" ) ), SORT_ASC, $item);
                if(count($item) > 3){
                    array_splice($item, 3);
                    $schedule[] = $item;
                }else{
                    $schedule[] = $item;
                }  
                unset($item);  
            }
        }
        if(isset($schedule[0])){
            return view('calendar-month.index',['Data'=>$Data],['Schedule'=>$schedule]);
        }else{
            return view('calendar-month.index',['Data'=>$Data]);
        }
    }

}
