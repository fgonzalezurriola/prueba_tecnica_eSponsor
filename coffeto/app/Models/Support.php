<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = ['page_id', 'supporter_name', 'message', 'amount'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
