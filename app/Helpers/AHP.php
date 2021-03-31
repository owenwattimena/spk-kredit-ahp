<?php 
namespace App\Helpers;
class AHP
{
    
    static function getRowTotal($datas)
    {
        $arr = array();
        foreach($datas as $key => $value)
        {
            foreach($value as $k => $v)
            {
                $arr[$k] = (!isset($arr[$k]) ? 0 : $arr[$k]) + $v;
            }
        }
        return $arr;
    }
    
    static function eigen($datas, $total)
    {
        $arr = array();
        foreach($datas as $key => $value)
        {
            foreach($value as $k => $v)
            {
                $arr[$key][$k] = $v / $total[0][$k];
            }
        }
        return $arr;
    }
    static function getTotal($normal)
    {
        $arr = array();
        foreach($normal as $key => $value)
        {   
            $arr[$key] = array_sum($value) ;   
        }
        // var_dump($arr);die;
        return $arr;
    }
    static function getPriority($normal)
    {
        $arr = array();
        foreach($normal as $key => $value)
        {   
            $arr[$key] = array_sum($value) / count($value);   
        }
        return $arr;
    }
    static function getCm($total, $priority)
    {
        $arr = array();
        foreach($total as $key => $value)
        {
            foreach($value as $k => $v)
            {
                $arr[$k] = $v * $priority[$key][$k];
            }
        }
        return $arr;
    }
    static function getConsistency($cm)
    {
        $arr = array();
        $sum = array_sum($cm);
        $count = count($cm);
        
        if(($count-1) > 0 && (($sum) - $count) > 0){
            $arr['ci'] = (($sum) - $count)/($count-1);
        }
        else{
            $arr['ci'] = 0; 
        }
        $nRi = [
            1 => 0,
            2 => 0,
            3 => 0.58,
            4 => 0.9,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.46,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59
        ];
        $ir = $nRi[$count];
        if($ir > 0){
            $arr['cr'] = $arr['ci']/$ir;
        }
        else{
            $arr['cr'] = 0;
        }
        
        return ($arr);
    }
}