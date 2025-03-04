<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class Tag extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];
    use HasFactory;
    public function posts(){
        return $this->belongsToMany(Post::class,'post_tags','tag_id','post_id');
    }
}
