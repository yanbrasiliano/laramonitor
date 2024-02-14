<?php

namespace App\Repositories;

use App\Models\Site;
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

  public function update($data, $uuid)
  {
    return Site::find($uuid)->endpoints()->update($data);
  }
}
