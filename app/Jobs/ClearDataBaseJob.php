<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ClearDataBaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     * This job deletes all force deleted comments and blogs.
     * Relations will be deleted.
     */
    public function handle(): void
    {
        $onlySoftDeletedBlogs = Blog::onlyTrashed()->get();
        $onlySoftDeletedComments = Comment::onlyTrashed()->get();
        
        foreach($onlySoftDeletedBlogs as $item){
            Storage::disk('public')->delete('uploads/'.$item->image);
            $item ->forceDelete();
        }
        foreach($onlySoftDeletedComments as $item){
            $item ->forceDelete();
        }
    }
}
