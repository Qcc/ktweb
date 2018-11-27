<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    /**
     * 当有发表回复时，话题回复数+1
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Reply $reply)
    {
        $reply->topic->increment('reply_count',1);
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content,'user_topic_body');
    }
}