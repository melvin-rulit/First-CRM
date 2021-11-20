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
        'itog_otchet',
    ];

    public $timestamps = false;

//        public function orders()
//    {
//        return $this->hasMany('App\Models\Order', 'racion');
//    }

    public function countOrders()
    {
        return $this->hasMany('App\Models\Order', 'racion')->count();
//            return $this->hasOne('App\Models\Order', 'racion');

    }

}
