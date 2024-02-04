<?php

namespace App\Services;

use App\Models\Site;
use App\Repositories\SitesRepository;

class SitesService
{
  private $sitesRepository;

  public function __construct(SitesRepository $sitesRepository)
  {
    $this->sitesRepository = $sitesRepository;
  }

  public function all()
  {
    return $this->sitesRepository->all();
  }

  public function create(array $data)
  {
    return $this->sitesRepository->create($data);
  }

  public function find($id)
  {
    return $this->sitesRepository->find($id);
  }

  public function update($id, array $data)
  {
    return $this->sitesRepository->update($id, $data);
  }

  public function delete(Site $site)
  {
    return $this->sitesRepository->delete($site);
  }
}
