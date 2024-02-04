<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUpdateSiteRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'url' => [
        'required',
        'url',
        Rule::unique('sites')->where(function ($query) {
          return $query->where('user_id', Auth::user()->id);
        }),
        'max:255',
      ]
    ];
  }
}
