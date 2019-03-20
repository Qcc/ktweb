<?php
namespace App\Handlers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadImgHandler
{
    /**
     * 下载图片到本地
     *
     * @param [type] $text
     * @return void
     */
    public function downloadImg($url,$folder = 'topics')
    {
        try {
            $client = new Client();
            $extentArray = explode('.', $url);
            $extension = array_pop($extentArray) ?? 'png';
            $filePath ="public/images/". $folder . "/" . date("Ym/d", time()) ."/".'_' . time() . '_' . str_random(15) . '.' . $extension;
            $file = $client->get($url)->getBody()->getContents();
            $boolSave = Storage::put( $filePath, $file,'public');
            if($boolSave){
              $imgUrl= Storage::url($filePath);
              return $imgUrl;
            }
            return false;
        } catch (GuzzleException $exception) {
            Log::info('下载图片失败:' . $url);
            return false;
        }
    }
}