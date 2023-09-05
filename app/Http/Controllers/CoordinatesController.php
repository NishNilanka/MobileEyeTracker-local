<?php

namespace App\Http\Controllers;

use App\Models\Coordinates;
use Illuminate\Http\Request;

class CoordinatesController extends Controller
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
        $sessionId = session('sid');
        $dateTimeset = date('Y-m-d H:i:s');
        $dateTime1 = str_replace(":", ".", $dateTimeset);
        $dateTime = str_replace("-", ".",  $dateTime1);

        $videoID = $request->videoID;
        $x_coordinates= $request->x_coordinates;
        $y_coordinates= $request->y_coordinates;
        $timestamps= $request->timestamps;

        $coordinates = new Coordinates([
            'sid' => $sessionId,
            'videoid'=> $videoID,
            'x' => $x_coordinates,
            'y' => $y_coordinates,
            'timestamps' => $timestamps,
            'created_at' => $dateTime,
            'updated_at' => $dateTime
        ]);

        $coordinates->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coordinates  $coordinates
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinates $coordinates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordinates  $coordinates
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinates $coordinates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coordinates  $coordinates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coordinates $coordinates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordinates  $coordinates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinates $coordinates)
    {
        //
    }
}
