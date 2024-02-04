<?php

namespace App\Repositories;

use App\Models\Site;
use App\Interfaces\SitesRepositoryInterface;


class SitesRepository implements SitesRepositoryInterface
{
  public function all()
  {
    return Site::all();
  }

  public function create(array $data)
  {
    return Site::create($data);
  }

  public function find($id)
  {
    return Site::find($id);
  }

  public function update($id, array $data)
  {
    $site = Site::find($id);
    return $site->update($data);
  }

  public function delete(Site $site)
  {
    return $site->delete();
  }
}
