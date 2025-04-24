<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Role extends Model
{
    
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
