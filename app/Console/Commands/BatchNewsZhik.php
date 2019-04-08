<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Models\User;

class BatchNewsZhik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:zhik';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发布临时文章到管理智库';

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
       $id = Redis::spop("news_3_set");
       if($id){
           Log::info('批量发布管理智库文章news_3_set,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
           $article = \DB::table('temparticle')->where('id', $id)->first();
           if($article){
               $news = new News;
               $news->column_id= 3;
               $news->title = $article->title;
               $news->body = $article->body;
               $news->keywords = $article->title;
               $news->image = $article->image;
               $news->source = $article->source;
               // 随机取2-61ID的机器人用户
               $news->user_id = $user->find(mt_rand(2,61))->id;
               $news->save();
               // 删除已发布的临时文章
               \DB::table('temparticle')->where('id',$id)->delete();
            }
        }
    }
}
