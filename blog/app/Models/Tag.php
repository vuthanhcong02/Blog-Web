<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    use HasFactory;
}
