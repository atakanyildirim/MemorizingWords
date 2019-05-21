<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Model\Word;
use App\Model\LearningList;
use App\Http\Controllers\LearnController;

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
        $learningListCount = LearningList::where('completed',0)->count();

        View::share(['wordCount' => $wordCount, 'learningListCount' => $learningListCount, 'user' => $userData]);
    }
}
