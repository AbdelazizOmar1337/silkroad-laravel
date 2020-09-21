<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    /**
     * @var string
     */
//    protected $table = 'donation_types';

    protected $fillable = [
        'name_web', 'description', 'name_merchant', 'price', 'silk', 'currency', 'type'
    ];

}
