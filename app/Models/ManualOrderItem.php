<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualOrderItem extends Model
{
    use HasFactory;

    protected $table = 'manual_order_items';

    protected $guarded = [];
}
