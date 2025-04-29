<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Voucher extends Model
{
    use SoftDeletes;
    //
    protected $table = 'vouchers';
    protected $fillable = [
        'discount',
        'discount_text',
        'code',
        'expired_at',
    ];

    public function user() : hasMany
    {
        return $this->hasMany(Product::class, 'voucher_id', 'id');
    }
}
