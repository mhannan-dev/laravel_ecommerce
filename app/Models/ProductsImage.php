<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    protected $table = 'product_images';
    protected $fillable =
    [
        'product_id','images','status','created_at','updated_at'
    ];
}
