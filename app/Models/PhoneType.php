<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\PhoneBrand;

class PhoneType extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $table = 'phone_types';

    protected $fillable = [
        'phone_type',
        'phone_brand_id'
    ];
}
