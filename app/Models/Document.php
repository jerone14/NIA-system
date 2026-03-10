<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=['title'];

    public function rows()
    {
        return $this->hasMany(DocumentRow::class);
    }
}
