<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * define primary key of the category model
     */
    protected $primaryKey = 'c_id';

    /**
     * define fillable columns of the category model
     */
    protected $fillable = ['c_name', 'c_image'];

    /**
     * @method for relationship between models
     */
    public function subCategory(){
        return $this->hasMany('App\Models\SubCategory', 'c_id');
    }

}
