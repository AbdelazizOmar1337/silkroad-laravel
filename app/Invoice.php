<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id', 'item_id', 'total', 'description'
    ];

    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
