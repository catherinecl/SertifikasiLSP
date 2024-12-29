<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shelf_number',
        'status'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category_relation', 'category_id', 'book_id');
    }
}
