<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\PostComment;
use App\Models\Like;
class Post extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id',

    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id'); //một bài viết "thuộc về" một người dùng
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function likes(){
        return $this->hasMany(Like::class,'post_id','id');
    }
    public function comments(){
        return $this->hasMany(PostComment::class,'post_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id');
    }
    public function isLikedByCurrentUser()
    {
        // Đây chỉ là ví dụ, bạn cần thay bằng cách kiểm tra thực tế
        // nếu người dùng hiện tại đã like bài viết hay chưa.
        $currentUser = auth()->user();

        if (!$currentUser) {
            return false;
        }

        // return $this->likes->contains('user_id', $currentUser->id);
        return $this->likes->contains('user_id', $currentUser->id); // tesst
    }

}
