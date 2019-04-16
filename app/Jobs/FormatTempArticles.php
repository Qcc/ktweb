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
        Log::info("原来的数据");
        Log::info($article->body);
        $body = trim($article->body);
        Log::info("trim的数据");
        Log::info($body);
        // 配置文件config/purifier.php
        // 使用插件过滤用户输入的内容
        $body = clean($body, 'temp_article_body');
        $article->reply1 = clean($article->reply1, 'temp_article_reply');
        $article->reply2 = clean($article->reply2, 'temp_article_reply');
        $article->reply3 = clean($article->reply3, 'temp_article_reply');
        $article->reply4 = clean($article->reply4, 'temp_article_reply');
        $article->reply5 = clean($article->reply5, 'temp_article_reply');
        $article->reply6 = clean($article->reply6, 'temp_article_reply');
        Log::info("过滤后的数据-开始");
        Log::info($body);
        Log::info($article->reply1);
        Log::info($article->reply2);
        Log::info($article->reply3);
        Log::info($article->reply4);
        Log::info($article->reply5);
        Log::info($article->reply6);
        Log::info("过滤后的数据-完");
        // 准备好关键词作为图片的alt，获取缓存的关键词
		$allKeywords =  [];
		$keys =  Redis::keys('keywords_*');
		foreach ($keys as $key) {
			array_push($allKeywords,Redis::get($key));
        }
        // 打乱关键词默认顺序，随机分布关键词数量
        shuffle($allKeywords);
        //提取文章中的img元素  
        /**
         * 0:array($result)
         * 0:"<img src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg" alt="aaa" width="600" height="366">"
         * 1:"<img alt="bbb" src="js/fckeditor/UserFiles/image/33_avatar_middle.jpg" width="120" height="120">"

         * 
         */
        preg_match_all('/<img[^>]+>/i',$body,$result);
        // 查找匹配存放匹配的关键词
        $altWords = [];
        // 控制关键词数量不超过10个
        $count = 10;
        // 一个img标签只使用一个关键词
        $length =  count($result[0]);
        foreach ($allKeywords as $index=>$word){
            if(strripos($body,$word)){
                array_push($altWords,$word);
                $redis_key = "link_".md5($word);
                $url = Redis::get($redis_key);
                if($url){
                    $link = '<a href="'.$url.'" target="_blank" title="'.$word.'">'.$word.'</a>';
                    $body = str_replace($word, $link, $body);
                }
                if($length <= count($altWords) && $count < 0){
                    Log::info("退出 count");
                    Log::info($count);
                    Log::info("退出 length");
                    Log::info($length);
                    break;
                }
                $count--;
            }
        }
        Log::info("替换好了关键词");
        Log::info($body);
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
            $url = strpos($src,"http://")?$src:$file;
            // 下载图片并返回存储url
            $path = app(DownloadImgHandler::class)->downloadImg($url);
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
                $flag = true;
            }
            // 删除日期数据
            
        }
        
        // Log::info("格式化完成的数据 ===== ".$body);
        // 写死的四张图片
        $pic = ['cangqiong','cloudhome','ctbs_advance','k3wise-1','eas-1','start','jdy-2','kis-1'];
        $image="/images/".$pic[array_rand($pic)].".png";
        if($flag){
            Log::info("图片下载失败 未发布 替换后的body   ".$body);
            Log::info("发布类型   ".$this->type);

            // 更新替换后的文章内容,将格式化状态设置为true
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
            //     ]); 
        }else{
            Log::info("发布成功   ".$body);
            Log::info("发布类型   ".$this->type);
            // \DB::table('temparticle')->where('id',$this->id)->update([
            //     'body'=>$body,
            //     'image'=>$path,
            //     'reply1'=>$article->reply1,
            //     'reply2'=>$article->reply2,
            //     'reply3'=>$article->reply3,
            //     'reply4'=>$article->reply4,
            //     'reply5'=>$article->reply5,
            //     'reply6'=>$article->reply6,
            //     'format'=>false,
            // ]);
        }
    }

    // 获得img标签的任意属性
    // protected function extract_attrib($tag) {
    //     preg_match_all('/(width|height|src|file)=("[^"]*")/i', $tag, $matches);
    //     $ret = array();
    //     foreach($matches[1] as $i => $v) {
    //         $ret[$v] = $matches[2][$i];
    //     } 
    //     return $ret;
    // }
    // 删除内容中的时间日期
    // protected function extract_date($content) {
    //     if($content){
    //         preg_match_all('/(\d{4}-\d{1,2}-\d{1,2}\s\d{1,2}:\d{1,2})/i',$content,$date);
    //         foreach ($date as $value) {
    //             $content = str_replace($value, "", $content);
    //         }   
    //     }
    //     return $content;
    // }
}
