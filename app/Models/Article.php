<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'author',
        'image',
        'content',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
