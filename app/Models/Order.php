<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

/**
 * @method static create(array $all)
 */
class Order extends Model
{
    use Filterable;


    protected $fillable = [
       'id',
       'orderid',
        'kurer',
        'kurer_id',
        'kvadrat_id',
        'nameus',
        'tel',
        'town',
        'adress',
        'racion',
        'total',
        'status',
        'status_kurer',
        'pay',
        'deliv',
        'comment',
        'datetimes',
        'datetimes_time',
        'use_time',
        'date_delivery',
        'end_Date',
        'start_edit',
        'first_edit',
        'type_zakaz',
        'array',
        'end_array',
    ];

    public $timestamps = false;


//    public function type()
//    {
////        return $this->hasOne('App\Models\Type', Type::class);
////        return $this->belongsTo('App\Models\Type', 'type_id');
//        return $this->hasMany('App\Models\Type', 'type_id');
////        return $this->belongsToMany('App\Models\Type', 'type' , 'type_id');
//    }

}
