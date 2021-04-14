<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class OrderProduct extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'order_products';

    protected $guarded = [];
}
