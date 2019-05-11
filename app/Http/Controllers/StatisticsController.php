<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LearningList;

class StatisticsController extends Controller
{
    /**
     * Aylık öğrenilen kelime sayısını gösteren grafik
     * @param Request $request
     * @return view
     */
    public function Index(Request $request)
    {
        if(!$request->all()) // Varsayılan değerler
        {
            $from = date('Y'.'-01-01');
            $to = date('Y-'.'12-31');
        }
        elseif($request->has('month') && $request->has('year'))
        {
            if($request->input('month') == -1) // Yıllık istatistik
            {
                $from = date($request->input('year').'-01-01');
                $to = date($request->input('year').'-12-31');
            }
            else // Belli bir yılın belli bir ayının istatistiği
            {
                $from = date($request->input('year').'-'.$request->input('month').'-01');
                $to = date($request->input('year').'-'.$request->input('month').'-31');
            }    
        }

        $numberOfLearnedWord = LearningList::whereBetween('updated_at', [$from, $to])->where('completed',1)->count();
        $numberOfUnLearnedWord = LearningList::whereBetween('updated_at', [$from, $to])->where('completed',0)->count();
        //dd($numberOfLearnedWord);
        return view('statistics')->with('numberOfLearnedWord',$numberOfLearnedWord)->with('numberOfUnLearnedWord',$numberOfUnLearnedWord);
    }
    
}