<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Word;
use App\Model\LearningList;

class WordController extends Controller
{
    /**
     * Veritabanından eklenen kelimeleri alır ve görünüme aktarır.
     *
     * @return view
     */
    public function Words()
    {
        $words = Word::orderBy('id','desc')->paginate(10);
        $data = ['words' => $words];
        return view('words',$data);
    }
    
   /**
     * Kullanıcıdan alınan kelime bilgilerinin doğrulaması yapıldıktan sonra veritabanına ekler.
     *
     * @param Request $request
     * @return Redirect
     */
    public function AddWord(Request $request)
    {
        // Form elemanlarının var olup olmama kontrolü.
        $messages = [
            'eng.required'       => 'İngilizce alanı boş bırakmayınız.',
            'tr.required'        => 'Türkçe alanı boş bırakmayınız.',
            'attribute.required' => 'Özellik alanını boş bırakmayınız.',
        ];
        
        $request->validate([
            'eng'       => 'required',
            'tr'        => 'required',
            'attribute' => 'required'
        ],$messages);

        $engWord = $request->input('eng');
        $trWord = $request->input('tr');
        $wordAttribute = $request->input('attribute');
        $sentence = $request->input('sentence');

        // Kelime daha önce eklendi mi kontrolü yapılıyor.
        $isAdded = Word::where('eng',$engWord)->count();
        if($isAdded > 0)
            return redirect(url()->previous())->with('title','Oops!')->with('color','warning')->with('message','Bu kelime daha önce eklenmiş.')->withInput();  
        
        // Tüm koşullar sağlanırsa kelimeyi veritabanına ekler.
        $newWord = new Word;
        $newWord->eng = strtolower($engWord);
        $newWord->tr = strtolower($trWord);
        $newWord->attribute = strtolower($wordAttribute);
        $newWord->sentence = $sentence;
        if($request->has('learn'))
            $newWord->learning_list = 1;
            
        $isSaved = $newWord->save();
        
        if($request->has('learn'))
        {
            $learningList = new LearningList;
            $learningList->stage = 1;
            $learningList->word_id = $newWord->id;
            $learningList->completed = 0;
            $learningList->save();
        }
        
        if($isSaved)
        {
            return redirect(url('/'))->with('title','Başarılı')->with('color','success')->with('message','Kelime başarıyla eklendi.');
        }
        else
            return redirect(url('/'))->with('title','Hata var :(')->with('color','danger')->with('message','Bir hata oluştu')->withInput();
    }
}
