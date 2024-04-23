<?php
namespace App\Services\TagServices;

use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;

class TagService
{
    /**
     * Creating new tag.
     */
    public function store($data){
        $created_tag = Tag::create([
            'name' => $data['name'],
        ]);   
        return new TagResource($created_tag);
    }

    /**
     * Updating exist tag.
     */
    public function update($data, $tag){
        $tag->update([
            'name' => $data['name'],
        ]);
        return new TagResource($tag);
    }
    
}

?>