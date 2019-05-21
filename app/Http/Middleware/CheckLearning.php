<?php

namespace App\Http\Middleware;
use App\Http\Controllers\LearnController;

use Closure;

class CheckLearning
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(LearnController::isLearningTime())
            return redirect()->route('Learn');
        else
            return $next($request);
    }
}
