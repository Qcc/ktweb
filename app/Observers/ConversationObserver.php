<?php

namespace App\Observers;

use App\Models\Conversation;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ConversationObserver
{
    /**
     * 当有发表回复时，话题回复数+1
     *
     * @param Reply $reply
     * @return void
     */
    public function created(Conversation $conversation)
    {
        
    }
    /**
     * 过滤用户输入
     *
     * @param Reply $reply
     * @return void
     */
    public function creating(Conversation $conversation)
    {
        $conversation->content = clean($conversation->content,'user_topic_body');
    }
  
}