<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //
    protected $table = 'roles';

    protected $fillable = ['name'];

    public $timestamps = [
        'created_at',
        'updated_at',
    ];
    

    public function users() : hasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
