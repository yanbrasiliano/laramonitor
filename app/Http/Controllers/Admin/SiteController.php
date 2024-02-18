<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use App\Services\SiteService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;
use App\Http\Requests\StoreUpdateSiteRequest;

class SiteController extends Controller
{

  private $siteService;

  public function __construct(SiteService $siteService)
  {
    $this->siteService = $siteService;
  }
  public function index()
  {
    $sites = SiteResource::collection($this->siteService->all());
    return view('admin.sites.index', compact('sites'));
  }

  public function store(StoreUpdateSiteRequest $request)
  {
    $this->siteService->create($request->validated());
    return redirect()->route('admin.sites.list');
  }

  public function update(StoreUpdateSiteRequest $request, $uuid)
  {
    $this->siteService->update($uuid, $request->all());
    return response()->json([
      'message' => 'Site updated successfully.'
    ]);
  }

  public function destroy($uuid)
  {
    $site = Site::where('id', $uuid)->firstOrFail();
    $this->siteService->delete($site);

    return response()->json([
      'message' => 'Site deleted successfully.'
    ]);
  }
}
