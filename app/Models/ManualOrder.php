<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualOrder extends Model
{
    use HasFactory;

    protected $table = 'manual_orders';

    protected $guarded = [];
}
