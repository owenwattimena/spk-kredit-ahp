<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Prioritas;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Models\DataAlternatif;

class RankingController extends Controller
{
    public function index(){
        $data['alternatif'] = Alternatif::all();
        $data['kriteria'] = Kriteria::all();
        $data['dataAlternatif'] = DataAlternatif::with(['alternatif', 'subkriteria'])->get();
        $data['prioritas'] = Prioritas::all();

        $data['bobotKriteria'] = [];
        $data['sumBobot'] = [];

        foreach ($data['alternatif'] as $key1 => $value1) {
            foreach ($data['kriteria'] as $key2 => $value2) {
                $data['bobotKriteria'][$key1][$key2] = $data['dataAlternatif']->where('id_alternatif', $value1->id)->where('id_kriteria', $value2->id)->first()->subkriteria->bobot;
            }
            $data['sumBobot'][$key1] = collect($data['bobotKriteria'][$key1])->sum();
        }
        $data['pembagianSumBobot'] = [];
        foreach ($data['alternatif'] as $key1 => $value1) {
            foreach ($data['bobotKriteria'][$key1] as $key2 => $value2) {
                $data['pembagianSumBobot'][$key1][$key2] = ($value2 / $data['sumBobot'][$key1]);
            }
        }
        $data['kaliRanking'] = [];

        foreach ($data['alternatif'] as $key1 => $value1) {
            foreach ($data['kriteria'] as $key2 => $value2) {
                $prioritas = isset($data['prioritas']->where('id_kriteria', $value2->id)->first()->prioritas) ? $data['prioritas']->where('id_kriteria', $value2->id)->first()->prioritas : 0;
                $prioritasKriteria = isset($data['pembagianSumBobot'][$key1][$key2]) ? $data['pembagianSumBobot'][$key1][$key2] : 0;
                $data['kaliRanking'][$key1][] =  $prioritasKriteria * $prioritas ;
            }
        }
        
        $data['ranking'] = [];

        foreach ($data['kaliRanking'] as $key => $value) {
            $data['ranking'][$key] = collect($value)->sum();
        }

        $data['result'] = [];
        foreach ($data['ranking'] as $key => $value) {
            $data['result'][$key]['alternatif'] =  $data['alternatif'][$key]->nama;
            $data['result'][$key]['pembagianSumBobot'] = $data['pembagianSumBobot'][$key];
            $data['result'][$key]['rank'] =  $value;
        }
        $data['result'] = collect($data['result'])->sortBy([
            ['rank', 'desc']
        ]);
        
        // dd($data);
        return view('ahp.ranking.index', $data);
    }
}