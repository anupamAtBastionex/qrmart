<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class ProductImages extends Model
{
    protected $appends = ['images'];
    protected $fillable=['product_id','image','status'];
    protected $table = 'product_images';
}
