<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Racion extends Model
{
    public $table = 'racions';

    protected $fillable = [

        'id',
        'name',
    ];

    public $timestamps = false;
}
