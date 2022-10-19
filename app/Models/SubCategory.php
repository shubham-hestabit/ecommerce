<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * define primary key of the sub category model
     */
    protected $primaryKey = 'sc_id';

    /**
     * define fillable columns of the sub category model
     */
    protected $fillable = ['sc_name', 'sc_image', 'c_id'];

    /**
     * @method for relationship between models
     */
    public function category(){
        
        return $this->belongsTo('App\Models\Category');
    }
}
