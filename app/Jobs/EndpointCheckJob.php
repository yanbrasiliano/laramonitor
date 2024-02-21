<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\Services\EndpointCheckerService;

class EndpointCheckJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $endpoint;
  protected $checkerService;


  /**
   * Create a new job instance.
   *
   * @param Endpoint $endpoint
   */
  public function __construct(Endpoint $endpoint, EndpointCheckerService $checkerService)
  {
    $this->endpoint = $endpoint;
    $this->checkerService = $checkerService;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    $url = $this->endpoint->url();

    try {
      $response = $this->checkerService->check($url);
      $this->endpoint->recordCheck($response->status(), $response->successful() ? 'Successful Request' : $response->body());
      Log::channel('check')->info("Endpoint check succeeded for URL: {$url} with status: {$response->status()}");
    } catch (\Exception $e) {
      Log::channel('check')->error("Endpoint check failed for URL: {$url} with error: {$e->getMessage()}");
    }
  }
}
