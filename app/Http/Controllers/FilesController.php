<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use \AetherUpload\RedisHandler as FileHsah;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function  store(Request $request, File $file)
    {
        $res = ['success' => true,'msg'=>'文件保存成功'];
        if($file->where('hash',$request->hash)->doesntExist()){
            $file->fill($request->all());
            if($file->logined == 'true'){
                $file->logined = true;
            }else{
                $file->logined = false;
            }
            $file->save();
        }else{
            $file = $file->where('hash',$request->hash)->first();
            $logined = $request->logined=='true'?true:false;
            if($file->logined != $logined){
                $file->logined = $logined;
                $file->save();
                $res = ['success' => false,'msg'=>'文件存在，下载权限已更新!'];
            }else{
                $res = ['success' => false,'msg'=>'文件已存在，可直接使用!'];
            }
        }
        return $res;
    }
    public function update(Request $request, File $file)
    {
        $file = $file->where('id',$request->id)->first();
        if($request->logined == 'true'){
            $file->logined = true;
        }else{
            $file->logined = false;
        }
        $file->save();
        return ['success' => true,'msg'=>'文件下载权限已更新。'];
    }
    public function destroy(Request $request, File $file)
    {
        $res = ['success' => false,'msg'=>'文件不存在。'];
        $file = $file->where('id',$request->id)->first();
        if(!$file){
            return $res;
        }
        $result =  Storage::delete('aetherupload/'.$file->path);
        if($result){
            FileHsah::deleteOneHash($file->hash);
            $file->delete();
            $res = ['success' => true,'msg'=>'文件删除成功。'];
        }
        return $res;
    }
}
