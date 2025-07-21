<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title', 'description', 'file', 'thumbnail', 'price', 'is_published'
    ];
}

