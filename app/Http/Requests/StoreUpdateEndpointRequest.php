<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;



class StoreUpdateEndpointRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'endpoint' => [
        'required',
        'string',
        Rule::unique('endpoints')->where(function ($query) {
          return $query->where('site_id', $this->site_id);
        }),
        'max:255',
      ],
      'frequency' => 'required|min:1',
    ];
  }
}
