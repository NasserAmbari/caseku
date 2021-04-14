<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\PhoneType;

class PhoneBrand extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'phone_brands';

    protected $fillable = [
        'phone_brand'
    ];

    // public $sortable = ['id','phone_brand'];
}
