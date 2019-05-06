<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Model\Word;
use App\Model\LearnWord;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $userInformation = file_get_contents('userInformation.json');
        $userData = json_decode($userInformation);

        $wordCount = Word::count();
        $learnedWordCount = LearnWord::where('completed',1)->count();

        View::share(['wordCount' => $wordCount, 'learnedWordCount' => $learnedWordCount, 'user' => $userData]);
    }
}
