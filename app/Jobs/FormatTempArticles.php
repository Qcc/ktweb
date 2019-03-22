<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Handlers\DownloadImgHandler;

class FormatTempArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $article = \DB::table('temparticle')->where('id',$request->id)->first();
        if($article){
            $article->body = trim($article->body);
        }
        // 匹配IMG标签正则
        $patternImg = '/<img[^>]+>/i';
        // 匹配IMG标签属性ALT SRC正则
        $patternAttr = '/(alt|src)=("[^"]*")/i';

        //提取文章中的img元素  
        /**
         * 0:array($result)
         * 0:"<img src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg" alt="aaa" width="600" height="366">"
         * 1:"<img alt="bbb" src="js/fckeditor/UserFiles/image/33_avatar_middle.jpg" width="120" height="120">"

         * 
         */
        preg_match_all($patternImg,$content,$result);  
        foreach( $result[0] as $img_tag)
        {
            // 匹配到img元素中的alt src属性
            /**
             * Array($img)
             * 0:array(2)
             * 0:"src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg""
             * 1:"alt="aaa""
             * 1:array(2)
             * 0:"src"
             * 1:"alt"
             * 2:array(2)
             * 0:""js/fckeditor/UserFiles/image/F201005201210502415831196.jpg""
             * 1:""aaa""
             */
            preg_match_all($patternAttr,$img_tag, $img);
            if(!empty($img)){
                //准备空数组存放alt与src
                $patterns= array();  
                $replacements = array();  
                // 根据 alt 和src 在IMG中出现的顺序不同，获取到的数组顺序也不同
                $src = $img[1][0];
                $alt = $img[1][1];
                //src 在前
                if($src == "src"){
                    $url = trim($img[2][0],'"');
                    $path = app(DownloadImgHandler::class)->downloadImg($url);
                    $replacements[0] =' src="'.$path.'" ';
                    $patterns[0] = "/".$img[0][0]."/";
                }else if($src == "alt"){
                    $replacements[1] =' alt="alt属性测试"';
                    $patterns[1] = "/".$img[0][1]."/";
                }
                // alt 在前
                if($alt == "src"){
                    $url = trim($img[2][1],'"');
                    $path = app(DownloadImgHandler::class)->downloadImg($url);
                    $replacements[1] =' src="'.$path.'" ';
                    $patterns[1] = "/".$img[0][1]."/";
                }else if($alt == "alt"){
                    $replacements[0] =' alt="alt属性测试"';
                    $patterns[0] = "/".$img[1][0]."/";
                }else{
                    // 没有alt 需要添加一个alt 属性
                    $replacements[0] =' alt="alt测试属性添加" src="'.$path.'" ';
                }
            
                //替换内容  
                $vote_content = preg_replace($patterns, $replacements, $content);
            }
        }
        // 下载图片并返回存储url
        $path = app(DownloadImgHandler::class)->downloadImg($url);
    }
}
