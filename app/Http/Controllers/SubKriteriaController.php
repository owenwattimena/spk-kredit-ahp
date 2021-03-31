<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $data['subkriteria'] = Subkriteria::with('kriteria')->get();
        return view('ahp.subkriteria.index', $data);
    }

    public function tambah()
    {
        $data['kriteria'] = Kriteria::all();
        return view('ahp.subkriteria.tambah',$data);
    }

    public function post(Request $request)
    {
        $request->validate([
            "id_kriteria" => "required",
            "nama" => "required",
            "bobot" => "required"
        ]);

        $subkriteria = new Subkriteria;
        $subkriteria->id_kriteria = $request->id_kriteria;
        $subkriteria->nama = $request->nama;
        $subkriteria->bobot = $request->bobot;

        if($subkriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Sub Kriteria Berhasil Ditambahkan!"
            ];
            return redirect()->route('ahp.subkriteria')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Sub Kriteria Gagal Ditambahkan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function ubah($id)
    {
        $data['kriteria'] = Kriteria::all();
        $data['subkriteria'] = Subkriteria::findOrFail($id);
        return view('ahp.subkriteria.edit',$data);
    }

    public function put(Request $request, $id)
    {
        $request->validate([
            "id_kriteria" => "required",
            "nama" => "required",
            "bobot" => "required"
        ]);

        $subkriteria = Subkriteria::findOrFail($id);
        $subkriteria->id_kriteria = $request->id_kriteria;
        $subkriteria->nama = $request->nama;
        $subkriteria->bobot = $request->bobot;

        if($subkriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Sub Kriteria Berhasil Diubah!"
            ];
            return redirect()->route('ahp.subkriteria')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Sub Kriteria Gagal Diubah!"
        ];
        return redirect()->back()->with($alert);
    }

    public function delete(Request $request, $id)
    {
        $subkriteria = Subkriteria::findOrFail($id);
        if($subkriteria->delete())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Sub Kriteria Berhasil Dihapus!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Sub Kriteria Gagal Dihapus!"
        ];
        return redirect()->back()->with($alert);
    }
}