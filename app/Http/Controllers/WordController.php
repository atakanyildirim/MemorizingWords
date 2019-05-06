<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Word;
use App\Model\LearnWord;

class WordController extends Controller
{
    /**
     * Veritabanından eklenen kelimeleri alır ve görünüme aktarır.
     *
     * @param Request $request
     * @return view
     */
    public function getWords(Request $request)
    {
        if($request->has('learned') && $request->input('learned') == 1)
        {
            $words = LearnWord::where('completed',1)->get();
            $heading = "Öğrendiklerim";
        }
        else
        {
            $words = Word::orderBy('id','desc')->paginate(12);
            $heading = "Kelimeler";
        }
        
        $data = ['words' => $words, 'heading' => $heading];
        return view('words',$data);

    }
   /**
     * Kullanıcıdan alınan kelime bilgilerinin doğrulaması yapıldıktan sonra veritabanına ekler.
     *
     * @param Request $request
     * @return Redirect
     */
    public function addWord(Request $request)
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
        $newWord->eng = $engWord;
        $newWord->tr = $trWord;
        $newWord->attribute = $wordAttribute;
        $newWord->sentence = $sentence;
        
        if($request->has('learn'))
        $newWord->is_learned = 1;

        if($newWord->save())
            return redirect(url('/'))->with('title','Başarılı')->with('color','success')->with('message','Kelime başarıyla eklendi.');
        else
            return redirect(url('/'))->with('title','Hata var :(')->with('color','danger')->with('message','Bir hata oluştu')->withInput();
    }
}
