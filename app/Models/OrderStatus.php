<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{

    use HasFactory;
    protected $table = 'order_status';
    protected $fillable =
    [
        'name','status'
    ];

}
