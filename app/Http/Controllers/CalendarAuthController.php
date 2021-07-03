<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class CalendarAuthController extends Controller
{
    public function user(){
        return view('calendar-user.index');
    }

    public function delete(){
        User::findOrFail(Auth::user()->id)->delete();
        Schedule::where('user_id',Auth::user()->id)->delete();
        return redirect('calendar-year');
    }

}
