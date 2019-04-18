<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Handlers\DownloadImgHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\News;
use App\Models\User;

class FormatTempArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //文章ID
    protected $id;
    // 发布到社区、行业资讯、管理智库
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 图片是否下载完整标记
        $flag=false;
        $article = \DB::table('temparticle')->where('id',$this->id)->first();
        if(!$article || $article->format){
            Log::info("未查到数据或者数据已被格式化，id是=>".$this->id);
            return false;
        }
        $body = trim($article->body);
        
        // 准备好关键词作为图片的alt，获取缓存的关键词
		$allKeywords =  [];
		$keys =  Redis::keys('keywords_*');
		foreach ($keys as $key) {
			array_push($allKeywords,Redis::get($key));
        }
        // 查找匹配存放匹配的关键词
        $altWords = [];
        // 打乱关键词默认顺序，随机分布关键词数量
        shuffle($allKeywords);
        // 控制关键词数量不超过10个
        $count = 10;
        // 匹配文章中的关键词
        // Log::info("开始关键词");
        foreach ($allKeywords as $index=>$word){
            if(strripos($body,$word)){
                array_push($altWords,$word);
                $count--;
                // Log::info("查找到关键词---".$word);
            }
            if($count < 0){
                break;
            }
        }
        // Log::info("所有匹配的关键词");
        Log::info($altWords);
        //提取文章中的img元素  
        /**
         * 0:array($result)
         * 0:"<img src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg" alt="aaa" width="600" height="366">"
         * 1:"<img alt="bbb" src="js/fckeditor/UserFiles/image/33_avatar_middle.jpg" width="120" height="120">"

         * 
         */
        preg_match_all('/<img[^>]+>/i',$body,$result);
        // 存放获取到的img
        $imgs = [];
        // 存放文章首图
        $image = "";
        foreach ($result[0] as $index => $tag) {
            $atts = extract_attrib($tag);
            $src="";
            $file="";
            $width="";
            $height="";
            if(array_key_exists('src',$atts)){
                $src = trim($atts['src'],'"');
            }
            if(array_key_exists('file',$atts)){
                $file = trim($atts['file'],'"');
            }
            if(array_key_exists('width',$atts)){

                $width = ' width='.$atts['width'];
            }else{
                $width = ' width="100%" ';
            }
            if(array_key_exists('height',$atts)){

                $height = ' height='.$atts['height'];
            }else{
                $height = ' height="100%" ';
            }
            if(!strpos($src,"http://") && $file){
                $src = $file;
            }
            // 下载图片并返回存储url
            $path = app(DownloadImgHandler::class)->downloadImg($src);
            if(!$path){
                $src = substr($article->source,0,strpos($article->source,"/",8)).$src;
                $path = app(DownloadImgHandler::class)->downloadImg($src);
            }
            //替换内容src  
            if($path){
                if($index == 0){
                    // 将文章的第一张图片作为首图
                    $image = $path;
                }
                // Log::info("返回的地址是 ".$path);
                $keyword = array_key_exists($index,$altWords)?$altWords[$index]:$article->title;
                $img = '<img src="'.$path.'" '.' alt="'.$keyword.'" '.$width.$height.' >';
                array_push($imgs,$img);
                $body = str_replace($tag, "tag_img_".$index, $body);
            }else{
                // 图片无法下载 返回
                Log::info("图片无法下载，标记当前文章格式化  ".$tag);
                Log::info("源地址是   ".$article->source);
                $flag = true;
            }
            // 删除日期数据
            
        }
        // 配置文件config/purifier.php
        // 使用插件过滤用户输入的内容
        $body = clean($body, 'temp_article_body');
        $article->reply1 = clean($article->reply1, 'temp_article_reply');
        $article->reply2 = clean($article->reply2, 'temp_article_reply');
        $article->reply3 = clean($article->reply3, 'temp_article_reply');
        $article->reply4 = clean($article->reply4, 'temp_article_reply');
        $article->reply5 = clean($article->reply5, 'temp_article_reply');
        $article->reply6 = clean($article->reply6, 'temp_article_reply');
        
        // 一个img标签只使用一个关键词
        $length =  count($result[0]);
        foreach ($altWords as $index=>$word){
            // Log::info("替换关键词".$word);
            $redis_key = "link_".md5($word);
            $url = Redis::get($redis_key);
            // Log::info("关键词 ".$word." url= ".$url);
            if($url){
                $link = '<a href="'.$url.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                $body = str_replace($word, $link, $body);
            }
        }
        // Log::info("替换好了关键词");
        // Log::info($body);
        
        foreach ($imgs as $i => $img) {
            $body = str_replace("tag_img_".$i, $img, $body);
        }
        // Log::info("替换好了IMG");
        // Log::info($body);
        // Log::info("格式化完成的数据 ===== ".$body);
        
        if($flag){
            Log::info("图片下载失败 未发布 替换后的body   ".$body);
            Log::info("发布类型   ".$this->type);

            // 更新替换后的文章内容,将格式化状态设置为true
            \DB::table('temparticle')->where('id',$this->id)->update([
                'body'=>$body,
                'image'=>$image,
                'reply1'=>$article->reply1,
                'reply2'=>$article->reply2,
                'reply3'=>$article->reply3,
                'reply4'=>$article->reply4,
                'reply5'=>$article->reply5,
                'reply6'=>$article->reply6,
                'format'=>true,
                ]); 
        }else{
            $user = new User;
            // 1发布到社区 2发布到行业新闻  3 发布到管理智库
            if($this->type == 1){
                $topic = new Topic;
                $topic->category_id= getCategory($article->category);
                $topic->title = $article->category."|".$article->title;
                $topic->body = $body;
                $topic->source = $article->source;
                // 随机取2-61ID的机器人用户
		        $topic->user_id = $user->find(mt_rand(2,61))->id;
                $topic->save();
                // 最多保存6条回复
                if($article->reply1 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply1;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply2 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply2;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply3 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply3;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply4 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply4;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply5 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply5;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                if($article->reply6 != ""){
                    $reply = new Reply;
                    $reply->content = $article->reply6;
                    $reply->user_id = $user->find(mt_rand(2,61))->id;
                    $reply->topic_id = $topic->id;
                    $reply->save();
                }
                Log::info("发布成功   ".$body);
                Log::info("发布类型   ".$this->type);
                Log::info("文章id   ".$topic->id);
            }else {
                // 写死的四张图片
                $pic = ['cangqiong','cloudhome','ctbs_advance','k3wise-1','eas-1','start','jdy-2','kis-1'];
                if($image == ""){
                    $image="/images/".$pic[array_rand($pic)].".png";
                }
                $news = new News;
                $news->column_id= $this->type;
                $news->title = $article->title;
                $news->keywords = "";
                $news->image = $image;
                $news->body = $body;
                $news->source = $article->source;
                // 随机取2-61ID的机器人用户
		        $news->user_id = $user->find(mt_rand(2,61))->id;
                $news->save();
                Log::info("发布成功   ".$body);
                Log::info("发布类型   ".$this->type);
                Log::info("文章id   ".$news->id);
            }
            // 删除已发布的临时文章
            \DB::table('temparticle')->where('id',$this->id)->delete(); 
        }
    }

}
