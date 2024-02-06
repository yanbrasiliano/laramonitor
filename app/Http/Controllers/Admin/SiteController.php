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

  public function show($id)
  {
    $site = $this->sitesService->find($id);
    return view('admin.sites.show', compact('site'));
  }

  public function edit($id)
  {
    $site = $this->sitesService->find($id);
    return view('admin.sites.edit', compact('site'));
  }

  public function update(StoreUpdateSiteRequest $request, $id)
  {
    $this->sitesService->update($id, $request->all());
    return redirect()->route('admin.sites.list');
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
