<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=['nombre','slug','descripcion'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
