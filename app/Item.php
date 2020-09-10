<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name', 'item_desc', 'item_price', 'item_silk','item_currency', 'item_'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    

}
