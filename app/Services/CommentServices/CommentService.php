<?php
namespace App\Services\CommentServices;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    /**
     * First we saving the blog's image in public storage,
     * after creating blog, and set him tags.
     */
    public function store($data){
        $comment = Comment::create([
            'content' => $data['content'],
            'owner' => Auth::id(),
            'blog_id' => $data['blog_id'],
        ]);
        return new CommentResource($comment);
    }
    /**
     * Updating the exist comment's content here.
     */
    public function update($data,$comment){
        $comment->update([
            'content' => $data['content'],
        ]);
        return new CommentResource($comment);
    }

     /**
     * Removing Comment.
     */
    
     public function delete($comment){
        $comment->delete();
        return new CommentResource($comment);
    }
}
?>