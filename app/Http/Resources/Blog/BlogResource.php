<?php

namespace App\Http\Resources\Blog;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Tag\TagResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $created_at = Carbon::parse($this->created_at)->format('y-F-d H:i');
        return [
            'id' =>$this->id,
            'image' => asset('storage/uploads/'. $this->image),
            'title' =>$this->title,
            'description' => $this->description,
            'posted_at'=> $created_at,
            'user_id'=>$this->user_id,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
