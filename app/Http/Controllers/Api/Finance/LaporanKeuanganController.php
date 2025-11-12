<?php

namespace App\Http\Controllers\Api\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Journal::with('cashFlow', 'account')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di tampilkan',
            'data' => $data,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Journal::find($id);

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ],200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $data,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Journal::find($id);

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ],200);
        }

        $data->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $data,
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                $data = Journal::find($id);

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ],200);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
            'data' => $data,
        ],200);

    }
}
