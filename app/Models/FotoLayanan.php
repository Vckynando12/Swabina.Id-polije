<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoLayanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'image1',
        'image2',
    ];
}
