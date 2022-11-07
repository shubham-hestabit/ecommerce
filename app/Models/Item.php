<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * define primary key of the product model
     */
    protected $primaryKey = 'item_id';

    /**
     * define fillable columns of the product model
     */
    protected $fillable = ['name', 'image', 'details', 'quantity', 'price', 'order_id', 'is_returned'];

    /**
     * @method for relationship between models
     */
    public function orders(){
        
        return $this->belongsTo('App\Models\Orders');
    }
}
