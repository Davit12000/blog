<?php
namespace App\Services\BlogService;

use App\Events\BlogCreated;
use App\Http\Resources\Blog\BlogResource;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogService
{
    /**
     * First we saving the blog's image in public storage,
     * after creating blog, and set him tags.
     */
    public function store($data, $hasTags){
        $fileName = $data['image']->getClientOriginalName();
        $data['image']->storeAs(
            'uploads',
            $fileName,
            'public'
        );

       
        $created_blog = Blog::create([
            'title' => $data['title'],
            'image' => $fileName,
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);
        if($hasTags){
            $arr = $data['tag'];
        $arr = array_unique($arr);
        $result = array_filter($arr, function($id){
            return Tag::find($id);
        });
        $created_blog->tags()->sync($result);
    
        }
        $user = Auth::user();
        event(new BlogCreated($user, $created_blog));
        return new BlogResource($created_blog);
    }
    /**
     * Updating the exist blog.
     * Deleting old image from public disk and saving new image.
     * After updating the post and set him tags.
     */
    public function update($data, $blog, $hasTags){
        Storage::disk('public')->delete('uploads/'.$blog->image);
        $fileName = $data['image']->getClientOriginalName();
        $data['image']->storeAs(
            'uploads',
            $fileName,
            'public'
        );
        $blog->update([
            'title' => $data['title'],
            'image' => $fileName,
            'description' => $data['description'],
            'user_id' => Auth::id(),
        ]);
        if($hasTags){
            $arr = $data['tag'];
        $arr = array_unique($arr);
        $blog->tags()->sync($arr);
    
        }
        return new BlogResource($blog);
    }

     /**
     * Removing blog, blog's image, tag's relations.
     * Tags relation will deleting automatically.
     */
    public function delete($blog){
        foreach($blog->comments as $comment){
            $comment->delete();
        }
        $blog->delete();
        return response()->noContent();
    }
    
}
?>
