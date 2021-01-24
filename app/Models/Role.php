<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(array $all)
 */
class Role extends Model
{
    public $table = 'roles';

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function rolesUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

