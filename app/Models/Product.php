<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'p_id';

    protected $fillable = ['p_name', 'p_price'];

    public function product(){
        
        return $this->belongsTo('App\Models\SubCategory');
    }

}
