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
            if(!$article || $article->format){
                Log::info("未查到数据或者数据不完整不能发布，id是=>".$this->id);
                return false;
            }
            $body = trim($article->body);
        
            // 准备好关键词作为图片的alt，获取缓存的关键词
		    $allKeywords =  [];
		    $keys =  Redis::keys('keywords_*');
		    foreach ($keys as $key) {
		    	array_push($allKeywords,Redis::get($key));
            }
            // 打乱关键词默认顺序，随机分布关键词数量
            shuffle($allKeywords);
            
            // 写死的四张图片
            // $pic = ['cangqiong','cloudhome','ctbs_advance','k3wise-1','eas-1','start','jdy-2','kis-1'];
            // $path="/images/".$pic[array_rand($pic)].".png";
            
            // 图片是否下载完整标记
            $flag=true;
            // 查找匹配存放匹配的关键词
            $altWords = [];
            // 控制关键词数量不超过10个
            $count = 10;
            //保存文章关键词
            // $keyword="";
            //提取文章中的img元素  
            /**
             * 0:array($result)
             * 0:"<img src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg" alt="aaa" width="600" height="366">"
             * 1:"<img alt="bbb" src="js/fckeditor/UserFiles/image/33_avatar_middle.jpg" width="120" height="120">"
             * 
             */
            preg_match_all('/<img[^>]+>/i',$body,$result);
            // 一个img标签只使用一个关键词
            $length =  count($result[0]);
            foreach ($allKeywords as $index=>$word){
                if(strripos($body,$word)){
                    array_push($altWords,$word);
                    // if($index < 3 ){
                    //     $keywords = $keyword.$word.",";
                    // }
                    $redis_key = "link_".md5($word);
                    $seourl = Redis::get($redis_key);
                    if($seourl){
                        $link = '<a href="'.$seourl.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                        $body = str_replace($word, $link, $body);
                    }
                    if($index >= $length && $index > $count){
                        break;
                    }
                }
            }
            foreach ($result[0] as $index => $tag) {
                $atts = $this->extract_attrib($tag);
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
                if(!strpos($src,"http://")){
                    $url = "https://club.kingdee.com/".$url;
                }
                // 下载图片并返回存储url
                $path = app(DownloadImgHandler::class)->downloadImg($url);
                if(!$path){
                    $path = app(DownloadImgHandler::class)->downloadImg($file);
                }
                //替换内容src  
                if($path){
                    Log::info("返回的地址是 ".$path);
                    $keyword = array_key_exists($index,$altWords)?$altWords[$index]:$article->title;
                    $img = '<img src="'.$path.'" '.' alt="'.$keyword.'" '.$width.$height.' >';
                    $body = str_replace($tag, $img, $body);
                }else{
                    // 图片无法下载 返回
                    Log::info("图片无法下载，跳过当前文章格式化  ".$tag);
                    Log::info("源地址是   ".$article->source);
                    $flag = false;
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
            if($flag){
                Log::info("body");
                Log::info($body);
                // $topic = new Topic;
                // $topic->category_id= getCategory($article->category);
                // $topic->title = $article->category."|".$article->title;
                // $topic->body = $body;
                // $topic->source = $article->source;
                // // 随机取2-61ID的机器人用户
                // $topic->user_id = $user->find(mt_rand(2,10))->id;
                // $topic->save();
                // // 最多保存6条回复
                // if($article->reply1 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply1;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // if($article->reply2 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply2;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // if($article->reply3 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply3;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // if($article->reply4 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply4;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // if($article->reply5 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply5;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // if($article->reply6 != ""){
                //     $reply = new Reply;
                //     $reply->content = $article->reply6;
                //     $reply->user_id = $user->find(mt_rand(2,10))->id;
                //     $reply->topic_id = $topic->id;
                //     $reply->save();
                // }
                // // 删除已发布的临时文章
                // \DB::table('temparticle')->where('id',$id)->delete();
            }else{
                // 更新替换后的文章内容,将格式化状态设置为true 未发布
                Log::info("未发布body");
                Log::info($body);
                // \DB::table('temparticle')->where('id',$this->id)->update([
                //     'body'=>$body,
                //     'image'=>$path,
                //     'reply1'=>$article->reply1,
                //     'reply2'=>$article->reply2,
                //     'reply3'=>$article->reply3,
                //     'reply4'=>$article->reply4,
                //     'reply5'=>$article->reply5,
                //     'reply6'=>$article->reply6,
                //     'format'=>true,
                // ]);
            }
        }
    }
}
