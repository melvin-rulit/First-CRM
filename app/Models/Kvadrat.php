<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kvadrat extends Model
{
    protected $fillable = [
        'id',
        'id_kurer',
        'sum_zakaz',
        'name'
    ];

    public $timestamps = false;

    public function kurer()
    {
        return $this->belongsTo('App\Models\User', 'id_kurer');
    }

//    public function kurer() {
//        return $this->hasMany(User::class);
//    }
}
