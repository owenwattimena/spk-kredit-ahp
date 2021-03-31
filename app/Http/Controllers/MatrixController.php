<?php

namespace App\Http\Controllers;

use App\Helpers\AHP;
use App\Models\Matrix;
use App\Models\Kriteria;
use App\Models\Prioritas;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    public function index()
    {
        $data['kriteria'] = Kriteria::all();
        $data['matrices'] = Matrix::all();
        $matrix = [];

        foreach ($data['kriteria'] as $key1 => $value1) {
            foreach ($data['kriteria'] as $key2 => $value2) {
                $bobot = $data['matrices']->where('baris', $value1->id)->where('kolom', $value2->id)->first();
                $matrix[$key1][] = $bobot == null ? 1 : $bobot->bobot;
            }
        }

        $data['matrix'] = $matrix;
        $data['total_matrix'] = AHP::getRowTotal($matrix);
        $data['nilai_eigen'] = AHP::eigen($matrix, [$data['total_matrix']]);
        $data['jumlah_eigen'] = AHP::getTotal($data['nilai_eigen']);
        $data['prioritas'] = AHP::getPriority($data['nilai_eigen']);
        $cm = AHP::getCm([$data['total_matrix']],[$data['prioritas']]);
        $data['konsistensi'] = AHP::getConsistency($cm);

        $result = [];

        foreach ($data['kriteria'] as $key => $value) {
            $result[$key]['id'] = $value->id;
            $result[$key]['kriteria'] = $value->nama;
            $result[$key]['prioritas'] = $data['prioritas'][$key];

            $prioritas = Prioritas::where([
                ['id_kriteria', '=', $value->id],
            ])->get()->first();

            if($prioritas)
            {
                if($prioritas->prioritas != $data['prioritas'][$key])
                {
                    $prioritas->prioritas = $data['prioritas'][$key];
                    $prioritas->save();
                }
            }
            else{

                $newPrioritas = new Prioritas;
                $newPrioritas->id_kriteria = $value->id;
                $newPrioritas->prioritas = $data['prioritas'][$key];
                $newPrioritas->save();
            }
        }
        $result = collect($result);
        $data['sort'] = $result->sortBy([
            ['prioritas', 'desc'],
        ]);
        // dd($data);

        return view('ahp.matrix.index', $data);
    }

    public function post(Request $request)
    {
        // dd($request->input());
        $matrixBaris = Matrix::where([
            ['baris', '=', $request->baris],
            ['kolom', '=', $request->kolom]
        ])->get()->first();

        if($matrixBaris)
        { 
            $matrixBaris->bobot = $request->bobot;
            $matrixBaris->save();

            $matrixKolom = Matrix::where([
                ['baris', '=', $request->kolom],
                ['kolom', '=', $request->baris]
            ])->get()->first();
            if($matrixKolom)
            {
                $matrixKolom->bobot = 1 / $request->bobot;
                $matrixKolom->save();
            }
            return redirect()->back();
        }
        
        $newMatrixBaris = new Matrix;
        $newMatrixBaris->baris = $request->baris;
        $newMatrixBaris->kolom = $request->kolom;
        $newMatrixBaris->bobot = $request->bobot;
        $newMatrixBaris->save();

        $newMatrixKolom = new Matrix;
        $newMatrixKolom->baris = $request->kolom;
        $newMatrixKolom->kolom = $request->baris;
        $newMatrixKolom->bobot = 1/$request->bobot;
        $newMatrixKolom->save();
        return redirect()->back();
    }
}