<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\PhoneType;

class ListStock extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'list_stocks';

    protected $fillable = [
        'phone_type_id',
        'case_type_id',
        'stock'
    ];

}
