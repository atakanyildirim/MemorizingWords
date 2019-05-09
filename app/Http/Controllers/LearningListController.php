<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LearningList;
use App\Model\Word;

class LearningListController extends Controller
{
    /**
    * Öğrenme listesini ve her kelimenin hangi aşamada olduğunu gösterir
    *
    * @return view
    */
    public function index()
    {
        $learningList = LearningList::OrderBy('id','desc')->paginate(10);
        return view('learning-list')->with('learningList',$learningList);
    }

    /**
    * İlgili kelimeyi öğrenecekler tablosuna ekler.
    *
    * @param int $wordId
    * @return redirect
    */
    public function AddLearningList($wordId)
    {
        $word = Word::find($wordId);
        $learningList = LearningList::where('word_id',$wordId)->count();
        if(!$word)
            return redirect(url('/'));
        
        if(!$learningList)
        {
            $learningList = new LearningList;
            $learningList->stage = 1;
            $learningList->word_id = $wordId;
            $learningList->completed = 0;
            $learningList->save();
        }
        
        if(!$word->learning_list)
        {
            $word->learning_list = 1;
            $word->save();
            return redirect(url()->previous())->with('title','Başarılı')->with('color','success')->with('message','Kelime başarıyla öğrenme listesine eklendi.');
        }
        return redirect(url()->previous())->with('title','Oops')->with('color','danger')->with('message','Bu kelime daha önce öğrenme listesine eklenildi');
    }
}
