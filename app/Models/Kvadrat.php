<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kvadrat extends Model
{
    protected $fillable = [
        'id',
        'id_kurer',
        'info',
        'sum_zakaz',
        'name'
    ];

    public $timestamps = false;

    public function kurer()
    {
        return $this->belongsTo('App\Models\User', 'id_kurer');
    }

}
