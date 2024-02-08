<?php

namespace App\Http\Controllers\Admin;

use App\Services\EndpointService;
use App\Http\Controllers\Controller;

class EndpointController extends Controller
{
  protected $endpointService;

  public function __construct(EndpointService $endpointService)
  {
    $this->endpointService = $endpointService;
  }
  public function index($uuid)
  {
    $endpoints =  $this->endpointService->findBySite($uuid);

    return view('admin.endpoints.index', compact('endpoints'));
  }
}
