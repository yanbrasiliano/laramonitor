<?php

namespace App\Repositories;

use App\Models\Site;
use App\Models\Endpoint;
use App\Interfaces\EndpointRepositoryInterface;


class EndpointRepository implements EndpointRepositoryInterface
{
  public function findBySite($uuid)
  {
    return Site::with('endpoints')->find($uuid);
  }

  public function store($data)
  {
    return Site::find($data['site_id'])->endpoints()->create($data);
  }

  public function update($data, $endpointId)
  {
    $endpoint = Endpoint::findOrFail($endpointId);
    $endpoint->update($data);
    return $endpoint;
  }

  public function destroy($siteUuid, $endpointUuid)
  {
    $endpoint = Endpoint::where('id', $endpointUuid)
      ->where('site_id', $siteUuid)->firstOrFail();
    $endpoint->delete();
  }
}
