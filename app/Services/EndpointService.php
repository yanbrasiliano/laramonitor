<?php

namespace App\Services;

use App\Models\Site;
use App\Models\Endpoint;
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
    $this->existsEndpoint($siteId, $data['endpoint']);

    $endpoint = $this->endpointRepository->store($data);

    return new EndpointResource($endpoint);
  }

  private function existsEndpoint($siteId, $endpointUrl)
  {
    $site = Site::find($siteId);
    if (!$site) {
      throw new \Exception("Site not found.");
    }

    if ($site->endpoints()->where('endpoint', $endpointUrl)->exists()) {
      throw new \Exception('Endpoint already exists.');
    }
  }

  public function update($data, $endpointId)
  {
    $endpoint = Endpoint::findOrFail($endpointId);
    $data['next_check_at'] = now()->addMinutes($data['frequency']);
    $endpoint->update($data);
    return new EndpointResource($endpoint);
  }

  public function destroy($siteUuid, $endpointUuid)
  {
    $this->endpointRepository->destroy($siteUuid, $endpointUuid);
  }
}
