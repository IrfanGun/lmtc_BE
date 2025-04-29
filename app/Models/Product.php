<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductDetail;
use App\Models\States;
use App\Models\Partnership;
use App\Models\Voucher;
use App\Models\Tag;
use App\Models\SubCategory;






class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;



    protected $table = 'products';
    protected $fillable = [
        'name',
        'store_address',
        'description',
        'partnership_id',
        'product_detail_id',
        'voucher_id',
        'state_id',
        'is_partnership',
        'img',
        'description_text',
        'discount',
        'discount_text',
        'category_id',
        'subcategory_id',
        

    ];

    public function product_details() : hasOne
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }

    public function states() : hasOne
    {
        return $this->hasOne(States::class, 'state_id', 'id');
    }

    public function partnership () : hasOne
    {
        return $this->hasOne(Partnership::class, 'partnership_id', 'id');
    }

    public function voucher() : hasOne
    {
        return $this->hasOne(Voucher::class, 'voucher_id', 'id');
    }

    public function tag() : hasMany
    {
        return $this->hasMany(Tag::class, 'product_id', 'tag_id');
    }
    public function category() : belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory() : belongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }


   
}
