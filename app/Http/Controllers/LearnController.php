<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LearningList;
use App\Model\Word;

class LearnController extends Controller
{
   /**
    * Listede öğrenilme zamanı gelmiş kelimelerin kontrolü yapılır.
    *
    * @return view
    */
    public function StartLearning()
    {
        $todayDate = date("Y-m-d");

        $oneDayAgo = new \DateTime($todayDate);
        $oneDayAgo->modify('-1 day');

        $sevenDayAgo = new \DateTime($todayDate);
        $sevenDayAgo->modify('-7 day');

        $oneMonthAgo = new \DateTime($todayDate);
        $oneMonthAgo->modify('-1 month');

        $sixMonthAgo = new \DateTime($todayDate);
        $sixMonthAgo->modify('-6 month');

        $stageOne = LearningList::where('created_at',$oneDayAgo->format('Y-m-d'))->where('stage',1)->where('completed',0)->get();
        $stageTwo = LearningList::where('created_at',$sevenDayAgo->format('Y-m-d'))->where('stage',2)->where('completed',0)->get();
        $stageThree = LearningList::where('created_at',$oneMonthAgo->format('Y-m-d'))->where('stage',3)->where('completed',0)->get();
        $stageFour = LearningList::where('created_at',$sixMonthAgo->format('Y-m-d'))->where('stage',4)->where('completed',0)->get();

        $data = ['stageOne' => $stageOne, 'stageTwo' => $stageTwo, 'stageThree' => $stageThree, 'stageFour' => $stageFour];

        return view('learn',$data);
    }

    /**
    * Kelime testinin cevaplarının doğru olup olmadığını ve gerekli işlemleri yapar.
    * @param Request $request
    * @return redirect
    */
    public function CheckTesting(Request $request)
    {
        if(count($request->all()) == 1) // Test sorularından hiç biri seçilmediyse uyarı ver
            return redirect(url('learn'))->with('message','Lütfen en az bir tanesini seçiniz.');

        $testResult = array();
        foreach($request->all() as $InputName => $value)
        {    
            if($InputName=="_token")
            continue;

            $LearningList = LearningList::find($InputName);
            $wordDetail = Word::find($LearningList->word_id);
            
            if($wordDetail->tr == $value)
            {
                if($LearningList->stage == 4)
                {
                    $LearningList->completed = 1;
                    $wordDetail->learned = 1;
                    $wordDetail->save();
                }
                else
                $LearningList->stage+= 1; 
                array_push($testResult,['ask' => $wordDetail->eng, 'answer' => $value, 'correct' => true]);
            }
            else 
            {
                $LearningList->stage= 1;
                $LearningList->created_at = date("Y-m-d"); // 1. aşamaya geri dönmesi için kelimenin tarihini bugüne atıyor.
                array_push($testResult, ['ask' => $wordDetail->eng,'rightAnswer' => $wordDetail->tr, 'answer' => $value, 'correct' => false]);              
            }

            $LearningList->save();
          }
          return redirect(url()->previous())->with('testResult',$testResult)->with('color','dark');
    }  
}