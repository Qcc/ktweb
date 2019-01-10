<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

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
        if($request->logined == '1'){
            $file->logined = true;
        }else{
            $file->logined = false;
        }
        return ['success' => true,'msg'=>'文件下载权限已更新。'];
    }
    public function destroy(Request $request, File $file)
    {
        $file = $file->where('id',$request->id)->first();
        $file->delete();
        return ['success' => true,'msg'=>'文件删除成功。'];
    }
}
