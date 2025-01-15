<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\User;
use App\Models\UserChat;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer(['*'], function (View $view) {
            $userAuth   = Auth::check() ? Auth::user() : null;
            // $chats      = null;

            // if ($userAuth)
            //     $chats = UserChat::where('user_id', $userAuth->id)
            //         ->with([
            //             'chat:id,participants,last_message',
            //             'chat.users' => function ($query) use ($userAuth) {
            //                 $query->where('user_id', '<>', $userAuth->id)->with('user:id,name,nick');
            //             },
            //         ])
            //         ->get();

            // if ($userAuth)
            //     $chats = Chat::where('participants.id', $userAuth->id)
            //         ->get();
                    
            $view->with([
                'userAuth'  => $userAuth,
                // 'chats'     => $chats
            ]);
        });

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/login');
            }
        });
    }
}
