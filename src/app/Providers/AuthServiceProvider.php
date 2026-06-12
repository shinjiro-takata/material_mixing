<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // 'admin-only' という名前のルールを作る
        Gate::define('admin-only', function (User $user) {
            // DB の値が 0/1 (または '0'/'1') の場合が多いので、真偽値にキャストして判定する
            return (bool) $user->is_admin;
        });
    }
}
