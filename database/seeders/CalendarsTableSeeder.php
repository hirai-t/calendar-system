<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strpad = function($str){
            str_pad($str, 1, '0', STR_PAD_LEFT);
            return $str;
        };
        for($year = 2020; $year <= 2051; $year++){
            for($month = 1;$month <= 12; $month++){
                $thisMonth = new Carbon($year . "-" . $strpad($month) . "-" . '01');

                for($day = 1;$day <= $thisMonth->daysInMonth; $day++){

                    $calData = new Carbon($year . "-" . $strpad($month) . "-" . $strpad($day));
                    $param['date'] = "$year-$month-$day";//年月日
                    $param['year'] = $year;//年
                    $param['month'] = $month;//月
                    $param['day'] = $day;//日
                    $param['dayOfWeek'] = $calData->dayOfWeek;//何曜日 日曜0から開始
                    $param['weekOfMonth'] = $calData->weekOfMonth;//月の何週目
                    $param['weekOfYear'] = $calData->weekOfYear;//年の何週目
                    $param['daysInMonth'] = $calData->daysInMonth;//月の日数
                    DB::table('calendars')->insert($param);
                }
            }
        }
    }
}