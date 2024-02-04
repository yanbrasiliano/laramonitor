<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Endpoint extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'endpoint',
    'frequency',
    'next_check_at',
  ];

  protected $casts = [
    'next_check_at' => 'datetime',
  ];

  public function site(): BelongsTo
  {
    return $this->belongsTo(Site::class);
  }

  public function checks(): HasMany
  {
    return $this->hasMany(Check::class);
  }
}
