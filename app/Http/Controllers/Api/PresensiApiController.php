<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresensiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensi = Presensi::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'massage' => 'Data berhasil dimuat',
            'data' => $presensi
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datapresensi = new Presensi;

        $rules = [
            'name'=>'required',
            'subject'=>'required',
            'date'=>'required|date',
            'topic'=>'required',
            'grade'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'massage'=>'Gagal memasukkan data',
                'data'=> $validator->errors()
            ]);
        }

        $datapresensi->name = $request->name;
        $datapresensi->subject = $request->subject;
        $datapresensi->date = $request->date;
        $datapresensi->topic = $request->topic;
        $datapresensi->grade = $request->grade;

        $post = $datapresensi->save();
        return response()->json([
            'status' => true,
            'massage' => 'Sukses memasukkan data'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $presensi = Presensi::find($id);
        if($presensi){
            return response()->json([
                'status' => true,
                'massage' => 'Data ditemukan',
                'data' => $presensi
            ], 200);
        } else{
            return response()->json([
                'status' => false,
                'massage' => 'Data tidak ditemukan'
            ]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $datapresensi = Presensi::find($id);
        if(empty($datapresensi)){
            return response()->json([
                'status'=>false,
                'massage'=>'Data tidak ditemukan'
            ],404);
        }

        $rules = [
            'name'=>'required',
            'subject'=>'required',
            'date'=>'required|date',
            'topic'=>'required',
            'grade'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'massage'=>'Gagal melalukan update data',
                'data'=> $validator->errors()
            ]);
        }

        $datapresensi->name = $request->name;
        $datapresensi->subject = $request->subject;
        $datapresensi->date = $request->date;
        $datapresensi->topic = $request->topic;
        $datapresensi->grade = $request->grade;

        $post = $datapresensi->save();
        return response()->json([
            'status' => true,
            'massage' => 'Sukses melakukan update data'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datapresensi = Presensi::find($id);
        if(empty($datapresensi)){
            return response()->json([
                'status'=>false,
                'massage'=>'Data tidak ditemukan'
            ],404);
        }

        $post = $datapresensi->delete();
        return response()->json([
            'status' => true,
            'massage' => 'Sukses melakukan delete data'
        ], 200);
    }
}
