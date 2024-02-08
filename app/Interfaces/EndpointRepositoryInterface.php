<?php

namespace App\Interfaces;


interface EndpointRepositoryInterface
{
  public function findBySite($uuid);
}
