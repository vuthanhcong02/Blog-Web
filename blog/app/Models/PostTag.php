<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;
class PostTag extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'post_id',
        'tag_id',
    ];
    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function tag(){
        return $this->belongsTo(Tag::class,'tag_id','id');
    }
}
