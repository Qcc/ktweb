<?php
namespace App\Handlers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadImgHandler
{
   // 只允许以下后缀名的图片文件上传
   protected $allowed_ext = ["png", "jpg", "gif", 'jpeg','bmp'];
    /**
     * 下载图片到本地
     *
     * @param [type] $text
     * @return void
     */
    public function downloadImg($url,$folder = 'topics')
    {
        Log::info('收到URL 准备下载 :' . $url);
        try {
            $client = new Client();
            $extentArray = explode('.', $url);
            $extension = array_pop($extentArray) ?? 'png';
            // 如果上传的不是图片将终止操作
            if ( ! in_array($extension, $this->allowed_ext)) {
                Log::info('图片格式不正确，下载图片失败:' . $url);
                return false;
            }
            $filePath ="public/images/". $folder . "/" . date("Ym/d", time()) ."/".'_' . time() . '_' . str_random(15) . '.' . $extension;
            $file = $client->get($url)->getBody()->getContents();
            $boolSave = Storage::put( $filePath, $file,'public');
            if($boolSave){
              $imgUrl= Storage::url($filePath);
              return config('app.url') . $imgUrl;
            }
            Log::info('下载图片失败:' . $url);
            return false;
        } catch (GuzzleException $exception) {
            Log::info('url无法访问，下载图片失败:' . $url);
            return false;
        }
    }
}