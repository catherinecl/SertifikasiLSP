<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_date',
        'status',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category_relation', 'book_id', 'category_id');
    }
    

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id', 'id');
    }
    
}