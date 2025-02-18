<?php
namespace App\Providers;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider
    as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//
    ];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('own-book', function (User $user, Register $register)
        {
            return $user->id == $register->user_id;
        });
    }
}
