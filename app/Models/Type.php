<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(array $all)
 * @method static find($id)
 */
class Type extends Model
{
    public $table = 'types';

    protected $fillable = [
        'id',
        'title',
        'kvadrat_id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}

