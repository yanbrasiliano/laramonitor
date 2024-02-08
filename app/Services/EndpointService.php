<?php

namespace App\Services;

use App\Repositories\EndpointRepository;

class EndpointService
{
  protected $endpointRepository;
  public function __construct(EndpointRepository $endpointRepository)
  {
    $this->endpointRepository = $endpointRepository;
  }

  public function findBySite($uuid)
  {
    $site = $this->endpointRepository->findBySite($uuid);
    if (!$site) {
      return \back();
    }
    $endpoints = $site->endpoints;

    return $endpoints;
  }
}
