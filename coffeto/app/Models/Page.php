<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = ['user_id', 'slug', 'title', 'bio', 'avatar_path'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class)->orderBy('sort_order');
    }

    public function supports(): HasMany
    {
        return $this->hasMany(Support::class)->latest();
    }

    public function addSupport(array $attributes): Support
    {
        return $this->supports()->create([
            'supporter_name' => $attributes['supporter_name'],
            'message' => $attributes['message'] ?? null,
            'amount' => $attributes['amount'],
        ]);
    }
}
