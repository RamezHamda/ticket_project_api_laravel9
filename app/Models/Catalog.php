<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function child(): HasMany
    {
        return $this->hasMany(Catalog::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Catalog::class, 'parent_id')->withDefault();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pool');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function thread(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function status()
    {
        return $this->status == 0 ? 'inActive' : 'active';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
