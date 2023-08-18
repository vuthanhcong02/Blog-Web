<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'parent_id',

    ];
}
