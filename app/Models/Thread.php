<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Thread extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attachment(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachmentable');
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class)->withDefault();
    }

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class)->withDefault();
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fw_user_id')->withDefault();
    }


}
