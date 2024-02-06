<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EndpointController extends Controller
{
  public function index($uuid)
  {
    return view('admin.endpoints.index', ['uuid' => $uuid]);
  }
}
