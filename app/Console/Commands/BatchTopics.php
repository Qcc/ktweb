<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Topic;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Models\Reply;
use App\Models\User;
use App\Jobs\FormatTempArticles;

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
            Log::info('批量发布社区文章topics_set成功,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
            dispatch(new FormatTempArticles($id,1))->delay(now()->addMinutes(rand(0, 5)));
        }else{
            Log::info('批量发布社区文章topics_set失败,ID='.$id."  执行时间：  ".date('Y-m-d H:i:s',time()));
        }
    }
}
