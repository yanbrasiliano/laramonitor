<?php

namespace App\Repositories;

use App\Models\Site;


class EndpointRepository
{
  public function findBySite($uuid)
  {
    return Site::with('endpoints')->find($uuid);
  }
}
