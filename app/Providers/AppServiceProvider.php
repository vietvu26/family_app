<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Person;
use App\Models\Thu;
use App\Observers\PeopleObserver;
use App\Observers\ThuObserver;
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
        Person::observe(PeopleObserver::class);
        Thu::observe(ThuObserver::class);
    }
}
