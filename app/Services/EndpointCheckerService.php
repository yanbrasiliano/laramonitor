<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class EndpointCheckerService
{
  public function check(string $url): Response
  {
    return Http::timeout(20)->get($url);
  }
}
