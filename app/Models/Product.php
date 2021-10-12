<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'product_code',
        'product_name',
        'product_image',
        'product_price',
        'product_desc',
        'product_stock',
        'category_id'
    ];
}
