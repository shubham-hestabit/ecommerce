<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * define primary key of the product model
     */
    protected $primaryKey = 'p_id';

    /**
     * define fillable columns of the product model
     */
    protected $fillable = ['p_name', 'p_price', 'p_image', 'p_details'];

    /**
     * @method for relationship between models
     */
    public function product(){
        
        return $this->belongsTo('App\Models\SubCategory');
    }

}
