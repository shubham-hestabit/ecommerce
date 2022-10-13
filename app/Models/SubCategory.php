<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'sc_id';

    protected $fillable = ['sc_name', 'c_id'];

    public function subCategory(){
        
        return $this->belongsTo('App\Models\Category');
    }
}
