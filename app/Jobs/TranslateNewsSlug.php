<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Models\News;
use App\Handlers\SlugTranslateHandler;

class TranslateNewsSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $news;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * 执行队列任务.
     *
     * @return void
     */
    public function handle()
    {
        // 请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->news->title);
        
        // 准备好关键词作关联，获取缓存的关键词
		$allKeywords =  [];
		$keys =  Redis::keys('keywords_*');
		foreach ($keys as $key) {
			array_push($allKeywords,Redis::get($key));
        }
        $keyword = $this->news->keywords;
        // 控制关键词数量不超过10个
        $count = 10;
        $body = $this->news->body;
        foreach ($allKeywords as $word) {
            if($count <= 0){
                break;
            }
            if(stripos($this->news->body,$word)){
                Log::info("this->news->keywords");
                Log::info($this->news->keywords);
                
                if($count > 6 && $this->news->keywords == ""){
                    $keyword = $keyword.$word.",";
                }
                Log::info("keyword");
                Log::info($keyword);
                $redis_key = md5($word);
                $url = Redis::get($redis_key);
                if($url){
                    $link = '<a href="'.$url.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                    $body = str_replace($word, $link, $body);
                    $ttl = Redis::ttl($redis_key);
                    Redis::setex($redis_key,$ttl,$this->news->link()."/".$slug);
                }else{                    
                    // 关键词链接默认保存90天，过期后自动删除
                    Redis::setex($redis_key,60*60*24*90,$this->news->link()."/".$slug);
                }
                $count--;
            }
        }
        //未来避免模型监控器死循环调用，使用DB类直接对数据库进行操作
        //任务中要避免使用 Eloquent 模型接口调用，如：create(), update(), save() 等操作。
        //否则会陷入调用死循环 —— 模型监控器分发任务，任务触发模型监控器，模型监控器再次分发任务，
        //任务再次触发模型监控器.... 死循环。在这种情况下，使用 DB 类直接对数据库进行操作即可。
        if($keyword){
            \DB::table('news')->where('id', $this->news->id)->update(['slug' => $slug,'keywords'=>$keyword,'body' => $body]);
        }else{
            \DB::table('news')->where('id', $this->news->id)->update(['slug' => $slug,'body' => $body]);
        }
    }
}
