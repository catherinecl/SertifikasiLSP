<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'name',
        'member_number',
        'phone_number',
        'join_date'
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'member_id', 'id');
    }
}
