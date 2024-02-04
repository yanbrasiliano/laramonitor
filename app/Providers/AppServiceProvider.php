<?php

namespace App\Providers;

use App\Services\SitesService;
use App\Repositories\SitesRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->singleton(SitesService::class, function ($app) {
      return new SitesService(new SitesRepository());
    });
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
