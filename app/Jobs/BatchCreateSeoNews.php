<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\News;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
// 使用队列批量新建SEO文章
class BatchCreateSeoNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(News $news)
    { 
        if(is_array($this->article)){
            News::create($this->article);
        }
    }
}
