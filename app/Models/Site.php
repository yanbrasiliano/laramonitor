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
    'user_id',
    'url',
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($site) {
      $site->uuid = (string) \Illuminate\Support\Str::uuid();
    });

    static::addGlobalScope('user', function ($builder) {
      $builder->where('user_id', auth()->id());
    });
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
