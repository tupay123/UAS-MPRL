<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'name', 'email', 'ebook_id', 'status', 'download_token'
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }

}
