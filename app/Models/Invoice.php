<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

            protected $fillable = [
                'product_id',
                'product_name',
                'qty',
                'price',
                'tax',
                'total',
                'discount',
                'Net',
                'user_id',
                'username',
            ];
}
