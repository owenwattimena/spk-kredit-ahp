<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $data['kriteria'] = Kriteria::all();
        return view('ahp.kriteria.index',$data);
    }

    public function tambah()
    {
        return view('ahp.kriteria.tambah');
    }

    public function post(Request $request)
    {
        $request->validate([
            "nama" => "required"
        ]);

        $kriteria = new Kriteria;
        $kriteria->nama = $request->nama;

        if($kriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Kriteria Berhasil Ditambahkan!"
            ];
            return redirect()->route('ahp.kriteria')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Kriteria Gagal Ditambahkan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function ubah($id)
    {
        $data['kriteria'] = Kriteria::findOrFail($id);
        return view('ahp.kriteria.ubah',$data);
    }

    public function put(Request $request, $id)
    {
        $request->validate([
            "nama" => "required"
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->nama = $request->nama;

        if($kriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Kriteria Berhasil Diubah!"
            ];
            return redirect()->route('ahp.kriteria')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Kriteria Gagal Diubah!"
        ];
        return redirect()->back()->with($alert);
    }

    public function delete(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        if($kriteria->delete())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Kriteria Berhasil Dihapus!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Kriteria Gagal Dihapus!"
        ];
        return redirect()->back()->with($alert);
    }
}