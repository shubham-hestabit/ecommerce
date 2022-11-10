<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'order_id';

    protected $fillable = ['user_id', 'charge_id', 'product_details'];

    /**
     * @method for relationship between models
     */
    public function user(){
        
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @method for relationship between models
     */
    public function items(){

        return $this->hasMany('App\Models\Item', 'order_id');

    }
}
