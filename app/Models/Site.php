<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Site extends Model
{
  use HasFactory;

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
