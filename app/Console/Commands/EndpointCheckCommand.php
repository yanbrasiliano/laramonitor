<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\EndpointCheckJob;
use App\Models\Endpoint;

class EndpointCheckCommand extends Command
{
  protected $signature = 'endpoint:check {endpoint_id}';
  protected $description = 'Check a specific endpoint';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $endpointId = $this->argument('endpoint_id');
    $endpoint = Endpoint::find($endpointId);

    if (!$endpoint) {
      $this->error("Endpoint with ID {$endpointId} not found.");
      return;
    }

    dispatch(new EndpointCheckJob($endpoint, app()->make(\App\Services\EndpointCheckerService::class)));
    $this->info("EndpointCheckJob dispatched for endpoint ID: {$endpointId}");
  }
}
