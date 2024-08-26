<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'product_barcode',
        'brand',
        'product_name',
        'ab_beautyworld',
        'hasaki',
        'guardian',
        'thegioiskinfood',
        'lamthao',
        'watsons',
        'socialla'
    ];
}
