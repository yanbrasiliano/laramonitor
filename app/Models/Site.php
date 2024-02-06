<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
  use  HasFactory, HasUuids;

  protected $fillable = [
    'user_id',
    'url',
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($site) {
      if (Auth::check()) {

        $site->user_id = Auth::id();
      }
      $site->id = (string) Str::uuid();
    });

    static::addGlobalScope('user', function ($builder) {
      if (Auth::check()) {
        $builder->where('user_id', Auth::id());
      }
    });
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
