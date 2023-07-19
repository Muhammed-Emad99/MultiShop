<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'image'];
    use HasFactory;
    function Products(){
        return $this->hasMany(Product::class);
    }
}
