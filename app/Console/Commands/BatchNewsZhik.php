<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use App\Jobs\FormatTempArticles;

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
            dispatch(new FormatTempArticles($id,3))->delay(now()->addMinutes(rand(0, 5)));
            Log::info('批量发布管理智库文章news_3_set成功,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
        }else{
            Log::info('批量发布管理智库文章news_3_set失败,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
        }
    }
}
