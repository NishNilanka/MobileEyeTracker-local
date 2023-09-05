<?php

namespace App\Http\Controllers;

use App\Models\DeviceOrientation;
use Illuminate\Http\Request;

class DeviceOrientationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sessionId = session('sid');
        $dateTimeset = date('Y-m-d H:i:s');
        $dateTime1 = str_replace(":", ".", $dateTimeset);
        $dateTime = str_replace("-", ".",  $dateTime1);

        $videoID = $request->videoID;
        $frameNumber = $request->frameNumber;
        $x_axis= $request->x_axis;
        $y_axis= $request->y_axis;
        $z_axis= $request->z_axis;

        $deviceOrientation = new DeviceOrientation([
            'sid' => $sessionId,
            'videoid'=> $videoID,
            'frameNumber' => $frameNumber,
            'x' => $x_axis,
            'y' => $y_axis,
            'z' => $z_axis,
            'created_at' => $dateTime,
            'updated_at' => $dateTime
        ]);

        $deviceOrientation->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeviceOrientation  $deviceOrientation
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceOrientation $deviceOrientation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeviceOrientation  $deviceOrientation
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceOrientation $deviceOrientation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeviceOrientation  $deviceOrientation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceOrientation $deviceOrientation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeviceOrientation  $deviceOrientation
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceOrientation $deviceOrientation)
    {
        //
    }



}
