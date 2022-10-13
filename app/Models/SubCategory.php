<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'sc_id';

    protected $fillable = 'sc_name';

    public function sub_category(){
        
        return $this->belongsTo('App\Models\Category');
    }
}
