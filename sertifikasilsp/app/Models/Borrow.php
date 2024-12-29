<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $table = 'borrow_book';
    protected $fillable = [
        'book_id', 
        'member_id', 
        'borrow_date', 
        'due_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    //each borrow is dibawah e book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
