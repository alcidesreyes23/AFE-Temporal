<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'price',
        'barcode',
        'image',
        'supplier_id',
        'user_id',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
