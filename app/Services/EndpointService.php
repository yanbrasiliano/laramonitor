<?php

namespace App\Services;

use App\Http\Resources\EndpointResource;
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

  public function store($data, $siteId)
  {
    $data['site_id'] = $siteId;
    $data['next_check_at'] = now()->addMinutes($data['frequency']);

    $endpoint = $this->endpointRepository->store($data);

    return new EndpointResource($endpoint);
  }
}
