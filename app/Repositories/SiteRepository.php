<?php

namespace App\Repositories;

use App\Models\Site;
use App\Interfaces\SiteRepositoryInterface;


class SiteRepository implements SiteRepositoryInterface
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

  public function update($uuid, array $data)
  {
    $site = Site::find($uuid);
    return $site->update($data);
  }

  public function delete(Site $site)
  {
    return $site->delete();
  }
}
