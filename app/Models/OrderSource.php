<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class OrderSource extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'order_sources';

    protected $fillable = [
        'order_source',
    ];
}
