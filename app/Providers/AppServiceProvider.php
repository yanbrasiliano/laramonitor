<?php

namespace App\Providers;

use App\Services\EndpointService;
use App\Services\SiteService;
use App\Repositories\SiteRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EndpointRepository;
use App\Interfaces\SiteRepositoryInterface;
use App\Interfaces\EndpointRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    /*
     Register the services and repositories in the container.
   */

    $this->app->singleton(SiteService::class);
    $this->app->singleton(SiteRepository::class);
    $this->app->singleton(EndpointRepository::class);
    $this->app->singleton(EndpointService::class);

    /* 
      Register the interfaces and repositories in the container.
    */

    $this->app->bind(SiteRepositoryInterface::class, SiteRepository::class);
    $this->app->bind(EndpointRepositoryInterface::class, EndpointRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
  }
}
