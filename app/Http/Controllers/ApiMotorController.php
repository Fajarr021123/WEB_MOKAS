<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class ApiMotorController extends Controller
{

    public function index()
    {
        $data = Motor::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required',
            'link_url_gambar' => 'required|url',
            'harga' => 'required|numeric',
            'tahun' => 'required|integer',
            'tipe' => 'required',
        ]);

        $motor = new Motor();
        $motor->nama_motor = $request->input('nama_motor');
        $motor->link_url_gambar = $request->input('link_url_gambar');
        $motor->harga = $request->input('harga');
        $motor->tahun = $request->input('tahun');
        $motor->tipe = $request->input('tipe');
        $motor->save();

        return response()->json(['message' => 'Motor added successfully']);
    }


    public function show(string $id)
    {
        $data = Motor::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',

            ]);
        }
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_motor' => 'required|unique:motor,nama_motor,' . $id,
            'link_url_gambar' => 'required|url',
            'harga' => 'required|numeric',
            'tahun' => 'required|integer',
            'tipe' => 'required',
        ]);

        $motor = Motor::find($id);
        if ($motor) {
            $motor->nama_motor = $request->input('nama_motor');
            $motor->link_url_gambar = $request->input('link_url_gambar');
            $motor->harga = $request->input('harga');
            $motor->tahun = $request->input('tahun');
            $motor->tipe = $request->input('tipe');
            $motor->save();

            return response()->json(['message' => 'Data motor berhasil diupdate']);
        } else {
            return response()->json(['message' => 'Motor ditemukan'], 404);
        }
    }
    public function search(Request $request)
    {
        $type = $request->input('type');
        $motors = Motor::where('tipe', $type)->get();
        return response()->json($motors);
    }


    public function destroy(string $id)
    {
        $motor = Motor::find($id);
        if ($motor) {
            $motor->delete();
            return response()->json(['message' => 'Data motor berhasil di hapus']);
        } else {
            return response()->json(['message' => 'Motor tidak ditemukan'], 404);
        }
    }
}
