<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Handlers\DownloadImgHandler;
use Illuminate\Support\Facades\Log;

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
        if(!$article){
            Log::info("未查到数据，id是=>".$request->id);
            return false;
        }
        $body = trim($article->body);
        $patternImg = '/<img[^>]+>/i';
        $patternAtl = '/alt="[^"]*"/i';
        $patternSrc = '/src="[^"]*"/i';

        //提取文章中的img元素  
        /**
         * 0:array($result)
         * 0:"<img src="js/fckeditor/UserFiles/image/F201005201210502415831196.jpg" alt="aaa" width="600" height="366">"
         * 1:"<img alt="bbb" src="js/fckeditor/UserFiles/image/33_avatar_middle.jpg" width="120" height="120">"

         * 
         */
        preg_match_all($patternImg,$body,$result);  
        //准备空数组存放alt与src
        foreach( $result[0] as $img_tag)
        {
            preg_match($patternAtl,$img_tag, $alt);
            $noAlt = false; //是否没有alt属性
            if(!empty($alt)){
                $replace =' alt="" ';
                $target = $alt[0];
                //替换内容alt  
                $body = str_replace($target, $replace, $body);
            }else{
                $noAlt = true;
            }
            preg_match($patternSrc,$img_tag, $src);
            if(!empty($src)){
                $url = trim(ltrim($src[0],"src="),'"');
                // 下载图片并返回存储url
                $path = app(DownloadImgHandler::class)->downloadImg($url);
                // 确认图片下载完成并返回了保存路径
                if($path){
                    if($noAlt){
                        
                        $replace =' alt="没有alt" src="'.$path.'" ';
                    }else{
                        $replace =' src="'.$path.'" ';
                    }
                    $target = $src[0];
                    //替换内容src  
                    $body = str_replace($target, $replace, $body);
                }
            }
        }
        // 更新替换后的文章内容
        $id = \DB::table('temparticle')->where('id',$request->id)->update(['body'=>$body]);
        
        
    }
}
