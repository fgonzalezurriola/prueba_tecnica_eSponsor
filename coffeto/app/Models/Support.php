<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Support extends Model
{
    protected $fillable = ['page_id', 'supporter_name', 'message', 'amount'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
