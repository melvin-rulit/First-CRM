<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Time extends Model
{
    public $table = 'times';

    protected $fillable = [
        'id',
        'time'
    ];

   public $timestamps = false;

}
