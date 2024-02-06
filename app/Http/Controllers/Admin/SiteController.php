<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use App\Services\SitesService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;
use App\Http\Requests\StoreUpdateSiteRequest;

class SiteController extends Controller
{

  private $sitesService;

  public function __construct(SitesService $sitesService)
  {
    $this->sitesService = $sitesService;
  }
  public function index()
  {
    $sites = SiteResource::collection($this->sitesService->all());
    return view('admin.sites.list', compact('sites'));
  }

  public function store(StoreUpdateSiteRequest $request)
  {
    $this->sitesService->create($request->validated());
    return redirect()->route('admin.sites.list');
  }

  public function update(StoreUpdateSiteRequest $request, $uuid)
  {
    $this->sitesService->update($uuid, $request->all());
    return response()->json([
      'message' => 'Site updated successfully.'
    ]);
  }

  public function destroy($uuid)
  {
    $site = Site::where('id', $uuid)->firstOrFail();
    $this->sitesService->delete($site);

    return response()->json([
      'message' => 'Site deleted successfully.'
    ]);
  }
}
