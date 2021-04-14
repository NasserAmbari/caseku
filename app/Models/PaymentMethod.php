<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PaymentMethod extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'payment_methods';
    
    protected $fillable = [
        'payment_method',
    ];
}
