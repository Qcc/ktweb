<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\Solutioncol;

class SolutioncolController extends Controller
{
    public function show(Solution $solution, Request $request, Solutioncol $solutioncol)
    {
        // 读取分类 ID  关联的话题， 并按照每20条分页
        $solutions = $solution->withOrder($request->order)
                        ->where('solutioncol_id',$solutioncol->id)
                        ->paginate(21);
        // 传参变量话题和分类 到模版中
        return view('pages.solution.index',compact('solutions','solutioncol'));
    }
}
