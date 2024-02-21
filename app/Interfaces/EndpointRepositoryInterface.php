<?php

namespace App\Interfaces;

interface EndpointRepositoryInterface
{
  public function findBySite($uuid);
  public function store($data);
  public function update($data, $uuid);
  public function destroy($siteUuid, $endpointUuid);
  public function logs($endpoint); 
}
