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

    public $news;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($news)
    {
        $this->news = $news;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(News $news)
    {
        $citys = Cache::rememberForever('soe_citys', function (){
			return \DB::table('seos')->get();
        });
        $article = $this->news;
        $citys->each(function ($item, $key) use($article){
            $title = str_replace('**',$item->city,$article['title']);
            $body = str_replace('**',$item->city,$article['body']);
            $keywords = str_replace('**',$item->city,$article['keywords']);
            News::create([
                'title'=>$title,
                'image'=>$article['image'],
                'body'=>$body,
                'user_id'=>$article['user_id'],
                'column_id'=>$article['column_id'],
                'keywords'=>$keywords,
                ]);
        });
    }
}
