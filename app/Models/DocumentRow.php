<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRow extends Model
{
    protected $fillable=[
        'document_id',
        'category_id',
        'name',
        'qty',
        'price',
        'total'
    ];
}
