<?php

namespace App\Providers;

use App\Models\Member;
use App\Models\User;
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
        view()->composer('users.Admin.layouts.app', function ($view) {
            $view->with('adminData', User::where('id', Auth::id())->first());
        });
        view()->composer('Users.Admin.layouts.app', function ($view) {
            $view->with('adminData', User::where('id', Auth::id())->first());
        });

        view()->composer('users.Partner.layouts.app', function ($view) {
            $view->with('partnerData', User::where('id', Auth::id())->first());
        });
        view()->composer('Users.Partner.layouts.app', function ($view) {
            $view->with('partnerData', User::where('id', Auth::id())->first());
        });

        view()->composer('users.Volunteer.layouts.app', function ($view) {
            $view->with('volunteerData', User::where('id', Auth::id())->first());
        });
        view()->composer('Users.Volunteer.layouts.app', function ($view) {
            $view->with('volunteerData', User::where('id', Auth::id())->first());
        });

        view()->composer('users.Member.layouts.app', function ($view) {
            $view->with(['userData' => User::where('id', Auth::id())->first(), 'memberData' => Member::where('user_id', Auth::id())->first()]);
        });
        view()->composer('Users.Member.layouts.app', function ($view) {
            $view->with(['userData' => User::where('id', Auth::id())->first(), 'memberData' => Member::where('user_id', Auth::id())->first()]);
        });

        view()->composer('users.Driver.layouts.app', function ($view) {
            $view->with('driverData', User::where('id', Auth::id())->first());
        });
        view()->composer('Users.Driver.layouts.app', function ($view) {
            $view->with('driverData', User::where('id', Auth::id())->first());
        });
    }
}
