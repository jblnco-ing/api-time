<?php
/**
* @OA\Info(title="API Time", version="1.0")
* @OA\Server(
*      url="https://api-time-laravel.herokuapp.com/",
*      description="HEROKU Server"
* ),
* @OA\Server(
*      url="http://localhost:8000/",
*      description="Local Server"
* )
*/
/**
*@OA\Tag(
*   name="Time",
*   description="Get times",
* )
*/
namespace App\Http\Controllers\Api\Time;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
    * @OA\Post(
    *     tags={"Time"},
    *     path="/api/time",
    *     summary="Display the time in utc format.",
    *      @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 required={"time","timezone"},
    *                 @OA\Property(
    *                    property="time",
    *                    type="string",
    *                    example="12:00:00"
    *                  ),
    *                  @OA\Property(
    *                    property="timezone",
    *                    type="string",
    *                    example="-0430"
    *                  ),
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Return the time in utc format.",
    *          @OA\JsonContent(
    *               @OA\Property(
    *                  property="response",
    *                  @OA\Property(
    *                   property="time",
    *                    type="string",
    *                    example="16:30:00"
    *                  ),
    *                  @OA\Property(
    *                    property="timezone",
    *                    type="string",
    *                    example="utc"
    *                  ),
    *              ),             
    *         ) 
    *     ),
    * )
    */
    /**
     * Display the time in utc format.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function time(Request $request)
    {
        $request->validate([
            'time'=>'date_format:H:i:s|required',
            'timezone'=>'numeric|required',
        ]);
        $time_i=$request->input('time');
        $timezone_i=$request->input('timezone');
        $dt = Carbon::createFromFormat('H:i:s',$time_i,$timezone_i)->setTimezone('UTC');
        $time=$dt->toTimeString();
        $timezone=strtolower($dt->timezone->getName());
        return response()->json(['response'=>['time'=>$time,'timezone'=>$timezone]]);
    }

}
