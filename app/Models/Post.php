<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id'];

    // protected function serializeDate(DateTimeInterface $date):string 
    // {
    //     return $date ->format('Y-m-d H:i:s');
    // }
}
