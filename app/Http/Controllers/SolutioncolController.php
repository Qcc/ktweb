<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\Solutioncol;

class SolutioncolController extends Controller
{
    public function show(Solution $solution, Request $request, Solutioncol $solutioncol)
    {
        // 读取分类 ID  关联的话题， 并按照每8条分页
        $solutions = $solution->where('solutioncol_id',$solutioncol->id)
                        ->orderby('updated_at','desc')
                        ->paginate(8);
                        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($solutioncol->slug) && $solutioncol->slug != $request->slug) {
            return redirect($solutioncol->link(), 301);
		}
        // 传参变量话题和分类 到模版中
        return view('pages.solution.solutions',compact('solutions','solutioncol'));
    }
    public function update(Request $request,Solutioncol $solutioncol)
    {
        $data = [
            'code'=>0,
            'msg'=>'类目更新成功!'
        ];
        $solutioncol = Solutioncol::find($request->id);
        $solutioncol->update($request->all());
        return $data;
    }

    public function store(Request $request, Solutioncol $solutioncol)
	{
        $data = [
            'code'=>0,
            'msg'=>'新建类目成功!'
        ];
		$solutioncol->fill($request->all());
		$solutioncol->save();
		return $data;
    }
    
    public function destroy(Request $request, Solutioncol $solutioncol)
	{
        $data = [
            'code'=>0,
            'msg'=>'删除类目成功!'
        ];
		$solutioncol = Solutioncol::find($request->id);
		$solutioncol->delete();
		return $data;
    }
}
