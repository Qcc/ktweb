<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Topic;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Models\Reply;
use App\Models\User;

class BatchTopics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:topics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发布临时文章到社区';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(User $user)
    {
        //这里做任务的具体处理，可以用模型
        $id = Redis::spop("topics_set");
        if($id){
            Log::info('批量发布社区文章topics_set,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
            $article = \DB::table('temparticle')->where('id', $id)->first();
            if($article){
                $topic = new Topic;
                $topic->category_id= getCategory($article->category);
                $topic->title = $article->category."|".$article->title;
                $topic->body = $article->body;
                $topic->source = $article->source;
                // 随机取2-61ID的机器人用户
                $topic->user_id = $user->find(mt_rand(2,10))->id;
                $topic->save();
                // 最多保存6条回复
                if($article->reply1 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply1;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply2 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply2;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply3 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply3;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply4 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply4;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply5 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply5;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply6 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply6;
                    $reply->user_id = $user->find(mt_rand(2,10))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                // 删除已发布的临时文章
                \DB::table('temparticle')->where('id',$id)->delete();
            }
        }
    }
}
