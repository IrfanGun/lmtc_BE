<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{
    use SoftDeletes;

    //
    protected $table = 'tags';
    protected $fillable = [
        'name',
        'product_id',
    ];

    public function products() : belongsTo
    {
        return $this->belongsTo(Product::class, 'product_tag', 'tag_id', 'product_id');

    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getRouteKey()
    {
        return $this->slug;
    }
}
