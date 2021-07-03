<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Calendar;
use Illuminate\Support\Facades\DB;

class CalendarYearController extends Controller
{
    public function index(Request $request) {
        $strpad = function($str){
            str_pad($str, 1, '0', STR_PAD_LEFT);
            return $str;
        };
        $now = Carbon::now();
        $year = substr($now, 0, 4);
        if($request->year !== null){
            $year = $request->year;
        }
        for($i=1;$i<=12;$i++){
            $dt = new Carbon($year.'-'.$strpad($i).'-01');
            $dt->dayOfWeekIso;
            $startDay = $dt->copy()->subDay($dt->dayOfWeekIso - 1)->format('Y-m-d');
            $Calendar[$i] = Calendar::where('date' , '>=' , $startDay)->limit(42)->get();
        }
        return view('calendar-year.index',['Calendar'=>$Calendar]);
    }

}
