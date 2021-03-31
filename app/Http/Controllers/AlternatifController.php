<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Models\DataAlternatif;

class AlternatifController extends Controller
{
    public function index()
    {
        $data['alternatif'] = Alternatif::all();
        return view('ahp.alternatif.index',$data);
    }
    public function pengajuan($id)
    {
        $data['alternatif'] = Alternatif::findOrFail($id);
        $data['kriteria'] = Kriteria::all();
        $data['subkriteria'] = Subkriteria::orderBy('bobot', 'desc')->get();
        $data['dataAlternatif'] = DataAlternatif::where('id_alternatif', $id)->get();
        // dd($data['dataAlternatif']->where('id_kriteria', 1)->where('id_subkriteria', 1)->first()->id_subkriteria ?? 0);
        return view('ahp.alternatif.pengajuan', $data);
    }

    public function postPengajuan(Request $request,$id)
    {
        foreach ($request->except('_token') as $key => $value) {

            $dataAlternatif              = DataAlternatif::where([
                ['id_alternatif', '=', $id],
                ['id_kriteria', '=', $key]
            ])->first();

            if($dataAlternatif)
            {
                // dump($value);
                // dd($dataAlternatif);
                if($dataAlternatif->id_subkriteria != $value){

                    $dataAlternatif->id_subkriteria   = $value;
                    $dataAlternatif->save(); 
                }
            }
            else{   
                $data = new DataAlternatif;
                $data->id_alternatif = $id;
                $data->id_kriteria = $key;
                $data->id_subkriteria = $value;
                $data->save();
            }
        }
        $alert = [
            "tipe" => "alert-success",
            "pesan"  => "Data pengajuan berhasil diubah!"
        ];
        return redirect()->back()->with($alert);
    }

    public function tambah()
    {
        return view('ahp.alternatif.tambah');
    }

    public function post(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "no_ktp" => "required",
            "jenis_kelamin" => "required",
        ]);

        $alternatif = new Alternatif;
        $alternatif->nama = $request->nama;
        $alternatif->no_ktp = $request->no_ktp;
        $alternatif->jenis_kelamin = $request->jenis_kelamin;

        if($alternatif->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Alternatif Berhasil Ditambahkan!"
            ];
            return redirect()->route('ahp.alternatif')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Alternatif Gagal Ditambahkan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function ubah($id)
    {
        $data['alternatif'] = Alternatif::findOrFail($id);
        return view('ahp.alternatif.ubah',$data);
    }

    public function put(Request $request, $id)
    {
        $request->validate([
            "nama" => "required",
            "no_ktp" => "required",
            "jenis_kelamin" => "required",
        ]);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->nama = $request->nama;
        $alternatif->no_ktp = $request->no_ktp;
        $alternatif->jenis_kelamin = $request->jenis_kelamin;

        if($alternatif->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Alternatif Berhasil Diubah!"
            ];
            return redirect()->route('ahp.alternatif')->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Alternatif Gagal Diubah!"
        ];
        return redirect()->back()->with($alert); 
    }

    public function delete(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        if($alternatif->delete())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Alternatif Berhasil Dihapus!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Alternatif Gagal Dihapus!"
        ];
        return redirect()->back()->with($alert);
    }
}