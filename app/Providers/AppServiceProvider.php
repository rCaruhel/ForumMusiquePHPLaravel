<?php

namespace App\Providers;

use App\Models\Publication;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('update-blog', function (User $user, Publication $blog) {
            if(!Auth::user()) return false;
            return ($user->id === $blog->user_id || $user->is_admin === 1); });

        Gate::define('create-group', function (User $user) {
            return $user->group_id===null;
        });

        Gate::define('leave-group', function (User $user) {
            if(Auth::user() === $user && $user->group) return true;
            return false;
        });

        Gate::define('addusertogroup', function () {
            if (Auth::user()->group_id !==null) return true;
            return false;
        });
    }
}
