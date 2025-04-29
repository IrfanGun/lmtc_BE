<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductDetails extends Model
{
    //
    use SoftDeletes;


    protected $table = 'product_details';
    
    protected $fillable = [
        'facebook_link',
        'web_link',
        'instagram_link',
        'email',
        'call_number',
        'maps_link',
        'url'
        
    ];

}
