<?php

namespace App\Http\Controllers;

use App\Models\CameraFeature;
use Illuminate\Http\Request;

class CameraFeatureController extends Controller
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

        $fps = $request->fps;
        $height= $request->height;
        $width= $request->width;
        $aspectratio= $request->aspectratio;

        $cameraFeature = new CameraFeature([
            'sid' => $sessionId,
            'fps'=> $fps,
            'height' => $height,
            'width' => $width,
            'aspectratio' => $aspectratio,
            'created_at' => $dateTimeset,
            'updated_at' => $dateTimeset
        ]);

        $cameraFeature->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CameraFeature  $cameraFeature
     * @return \Illuminate\Http\Response
     */
    public function show(CameraFeature $cameraFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CameraFeature  $cameraFeature
     * @return \Illuminate\Http\Response
     */
    public function edit(CameraFeature $cameraFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CameraFeature  $cameraFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CameraFeature $cameraFeature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CameraFeature  $cameraFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(CameraFeature $cameraFeature)
    {
        //
    }
}
