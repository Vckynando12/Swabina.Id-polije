<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextSS extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'text_align'];
}
