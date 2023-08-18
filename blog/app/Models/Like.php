<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
