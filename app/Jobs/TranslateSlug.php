<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * 执行队列任务.
     *
     * @return void
     */
    public function handle()
    {
        // 请求百度 API 接口进行翻译
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);
        // 新的地址
        $newsUrl = $this->topic->link()."/".$slug; 
        // 准备好关键词作关联，获取缓存的关键词
		$allKeywords =  [];
        $keys =  Redis::keys('keywords_*');
        foreach ($keys as $key) {
            array_push($allKeywords,Redis::get($key));
        }
        // 控制关键词数量不超过10个
        $count = 10;
        $keyword = "";
        $body = $this->topic->body;
        foreach ($allKeywords as $word) {
            if($count <= 0){
                break;
            }
            if(stripos($this->topic->body,$word)){
                if($count > 6){
                    $keyword = $keyword.$word.",";
                }
                $redis_key = "link_".md5($word);
                $url = Redis::get($redis_key);
                if($url){
                    if(!$this->topic->source){
                        $link = '<a href="'.$url.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                        $body = str_replace($word, $link, $body);
                    }
                    $ttl = Redis::ttl($redis_key);
                    Redis::setex($redis_key,$ttl,$newsUrl);
                }else{                    
                    // 关键词链接默认保存90天，过期后自动删除
                    Redis::setex($redis_key,60*60*24*90,$newsUrl);
                }
                $count--;
            }
        }
        //未来避免模型监控器死循环调用，使用DB类直接对数据库进行操作
        //任务中要避免使用 Eloquent 模型接口调用，如：create(), update(), save() 等操作。
        //否则会陷入调用死循环 —— 模型监控器分发任务，任务触发模型监控器，模型监控器再次分发任务，
        //任务再次触发模型监控器.... 死循环。在这种情况下，使用 DB 类直接对数据库进行操作即可。
        if ($keyword) {
            \DB::table('topics')->where('id', $this->topic->id)->update(['body' => $body,'keywords' => $keyword,'slug' => $slug]);
        }else{
            \DB::table('topics')->where('id', $this->topic->id)->update(['body' => $body,'slug' => $slug]);
        }
        // 百度主动推送
        $urls = array($newsUrl);
        // $api = 'http://data.zz.baidu.com/urls?site=www.kouton.com&token=Ni7aXOJYzIfwW1iX';
        $api = "http://data.zz.baidu.com/urls?site=".env('BAIDU_AUTOURL_URL')."&token=".env('BAIDU_AUTOURL_KEY');
        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        Log::info("百度自动推动结果:");
        Log::info($result);
    }
}
