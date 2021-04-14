<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CaseType extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'case_types';

    protected $fillable = [
        'case_type',
        'price',
    ];

    // public $sortable = ['id','case_type','price','created_at','updated_at'];
}
