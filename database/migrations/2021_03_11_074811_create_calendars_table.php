<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('date_id')->comment('日付ID');
            $table->date('date')->comment('年月日');
            $table->smallInteger('year')->comment('年');
            $table->tinyInteger('month')->comment('月');
            $table->tinyInteger('day')->comment('曜日 日曜:0~土曜:6');
            $table->tinyInteger('dayOfWeek')->comment('曜日 日曜:0~土曜:6');
            $table->tinyInteger('weekOfMonth')->comment('月の何週目');
            $table->tinyInteger('weekOfYear')->comment('年の何週目');
            $table->tinyInteger('daysInMonth')->comment('月の日数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
