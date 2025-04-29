<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class States extends Model
{
    use SoftDeletes;
    //
    protected $table = 'states';
    protected $fillable = [
        'name',
        'short_name',
        
    ];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'state_id', 'id');
    }
  
}
