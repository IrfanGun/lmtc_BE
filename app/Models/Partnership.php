<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Models\Product;

class Partnership extends Model
{
    use SoftDeletes;

    protected $table = 'partnerships';
    protected $fillable = [
        'is_exclusive',
        'is_featured',
        'is_popular',
        'is_affiliate',
        
    ];

    public function products() : belongsTo
    {
        return $this->belongTo(Product::class, 'partnership_id', 'id');
    }
    //
}
