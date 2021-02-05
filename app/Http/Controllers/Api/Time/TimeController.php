<?php

namespace App\Http\Controllers\Api\Time;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function time(Request $request)
    {
        $request->validate([
            'hour'=>'date_format:H:i:s|required',
            'timezone'=>'numeric|required',
        ]);
        $hour=$request->input('hour');
        $timezone_i=$request->input('timezone');
        $dt = Carbon::createFromFormat('H:i:s',$hour,$timezone_i)->setTimezone('UTC');
        $time=$dt->toTimeString();
        $timezone=strtolower($dt->timezone->getName());
        return response()->json(['response'=>['time'=>$time,'timezone'=>$timezone]]);
    }

}
