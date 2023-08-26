<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }
}
