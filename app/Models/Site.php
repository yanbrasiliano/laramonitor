<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'url',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
