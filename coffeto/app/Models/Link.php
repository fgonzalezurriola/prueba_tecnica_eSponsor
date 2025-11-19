<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $fillable = ['page_id', 'title', 'url', 'sort_order'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
