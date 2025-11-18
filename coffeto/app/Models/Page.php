<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['user_id', 'slug', 'title', 'bio', 'avatar_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class)->orderBy('sort_order');
    }

    public function supports()
    {
        return $this->hasMany(Support::class)->latest();
    }
}
