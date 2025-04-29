<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;

class SubCategory extends Model
{
    //
    use SoftDeletes;

    protected $table = 'sub_categories';
    protected $fillable = [
        'name',
        'category_id',

    ];

    protected $casts = [
        'category_id' => 'integer',
    ];

    public function product() : hasMany
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


}
