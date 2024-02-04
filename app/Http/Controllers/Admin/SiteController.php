<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SitesService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;

class SiteController extends Controller
{

  private $sitesService;

  public function __construct(SitesService $sitesService)
  {
    $this->sitesService = $sitesService;
  }
  public function index()
  {
    return SiteResource::collection($this->sitesService->all());
    // return view('admin.sites.list', compact('sites'));
  }

  public function create()
  {
    return view('admin.sites.create');
  }

  public function store(Request $request)
  {
    $this->sitesService->create($request->all());
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

  public function update(Request $request, $id)
  {
    $this->sitesService->update($id, $request->all());
    return redirect()->route('admin.sites.list');
  }

  public function destroy($id)
  {
    $this->sitesService->delete($id);
    return redirect()->route('admin.sites.list');
  }
}
