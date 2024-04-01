<?php

namespace App\Providers;

use App\Contracts\GuessValidatorInterface;
use App\Contracts\NumberGeneratorInterface;
use App\Contracts\ScoreTrackerInterface;
use App\Http\Services\GuessValidator;
use App\Http\Services\ScoreTracker;
use App\Http\Services\UniqueNumberGenerator;
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
        $this->app->bind(NumberGeneratorInterface::class, UniqueNumberGenerator::class);
        $this->app->bind(GuessValidatorInterface::class, GuessValidator::class);
        $this->app->bind(ScoreTrackerInterface::class, ScoreTracker::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
