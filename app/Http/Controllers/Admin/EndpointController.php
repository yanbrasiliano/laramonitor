<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use App\Services\EndpointService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EndpointResource;
use App\Http\Requests\StoreUpdateEndpointRequest;
use App\Models\Endpoint;

class EndpointController extends Controller
{
  protected $endpointService;

  public function __construct(EndpointService $endpointService)
  {
    $this->endpointService = $endpointService;
  }
  public function index($uuid)
  {
    $site = Site::where('id', $uuid)->firstOrFail();
    $this->authorize('owner', $site);
    $endpoints = EndpointResource::collection($site->endpoints);
    return view('admin.endpoints.index', compact('endpoints', 'site'));
  }

  public function store(StoreUpdateEndpointRequest $request, $uuid)
  {
    $site = Site::where('id', $uuid)->firstOrFail();
    $data = $request->validated();
    $this->authorize('owner', $site);


    $endpoint = $this->endpointService->store($data, $site->id);

    return $endpoint;
  }

  public function update(StoreUpdateEndpointRequest $request, $siteUuid, $endpointUuid)
  {
    $site = Site::where('id', $siteUuid)->firstOrFail();
    $this->authorize('owner', $site);

    $endpoint = $site->endpoints()->where('id', $endpointUuid)->firstOrFail();

    $data = $request->validated();
    $endpoint = $this->endpointService->update($data, $endpoint->id);

    return $endpoint;
  }

  public function destroy($siteUuid, $endpointUuid)
  {

    $this->endpointService->destroy($siteUuid, $endpointUuid);

    return response()->json(['message' => 'Endpoint deleted.']);
  }

  public function logs($endpoint)
  {
    $site = Site::where('id', $endpoint->site_id)->firstOrFail();
    $this->authorize('owner', $site);

    $logs = $this->endpointService->logs($endpoint);
    return view('admin.endpoints.logs', compact('logs'));
  }
}
