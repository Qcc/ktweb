<?php
namespace App\Handlers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class DownloadImgHandler
{
    /**
     * 下载图片到本地
     *
     * @param [type] $text
     * @return void
     */
    public function download($url)
    {
        // 实例化Http客户端
        try {
            $http = new Client(['verify' => false]);  //忽略SSL错误
            $client->get($url, ['save_to' =>$path]);  //保存远程url到文件
        } catch (GuzzleException $e) {
            Log::info('下载图片失败!');
        }

        return $result;
    }

    public function downloadImage($url, $path='images/')
    {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
      $file = curl_exec($ch);
      curl_close($ch);
  
      $this->saveAsImage($url, $file, $path);
    }
  
    private function saveAsImage($url, $file, $path)
    {
      $filename = pathinfo($url, PATHINFO_BASENAME);
      $resource = fopen($path . $filename, 'a');
      fwrite($resource, $file);
      fclose($resource);
    }
}