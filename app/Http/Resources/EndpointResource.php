<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EndpointResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'site_id' => $this->site_id,
      'url' => $this->endpoint,
      'frequency' => $this->frequency,
      'next_check_at' => $this->next_check_at ? Carbon::parse($this->next_check_at)->toDateTimeString() : null,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
