<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function($view) {
            $user = Auth::user();
            $memoModel = new Memo();
            $memos = $memoModel->myMemo( Auth::id() );

            $tagModel = new Tag();
            $tags = $tagModel->where('user_id', Auth::id())->get();

            $view->with('user', $user)->with('memos', $memos)->with('tags', $tags);
        });
    }
}
