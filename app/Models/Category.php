<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'c_id';

    protected $fillable = 'c_name';

    public function category(){
        
        return $this->belongsTo('App\Models\Users');
    }
}
