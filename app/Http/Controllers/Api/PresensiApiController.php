<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensi = Presensi::paginate(10);
        return response()->json([
            'data' => $presensi
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $presensi = Presensi::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'date' => $request->date,
            'topic' => $request->topic,
            'grade' => $request->grade
        ]);
        return response()->json([
            'data' => $presensi
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        return response()->json([
            'data' => $presensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presensi $presensi)
    {
        $presensi->name = $request->name;
        $presensi->subject = $request->subject;
        $presensi->date = $request->date;
        $presensi->topic = $request->topic;
        $presensi->grade = $request->grade;
        $presensi->save();
        return response()->json([
            'data' =>$presensi
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        $presensi ->delete();
        return response()->json([
            'massage' => 'customer deleted'
        ], 204);
    }
}
