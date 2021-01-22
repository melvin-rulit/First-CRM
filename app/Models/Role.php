<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Role extends Model
{
    use HasFactory;

    public $table = 'roles';

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    /**
     * @var mixed
     */
    private $title;

    public function rolesUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

