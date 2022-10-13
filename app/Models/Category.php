<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'c_id';

    public function subCategory(){

        return $this->hasOneThrough('App\Models\SubCategory', 'App\Models\Category', 'c_id', 'sc_id');
    }

}
