<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ShippingMethod extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'shipping_methods';

    protected $fillable = [
        'shipping_method',
    ];
}
