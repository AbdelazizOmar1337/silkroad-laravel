<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id', 'doty_id', 'total', 'description', 'payment_id', 'paid', 'closed'
    ];

    public function donationType()
    {
        return $this->belongsTo(DonationType::class, 'doty_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
