<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solutioncol;
use App\Models\Solution;
use App\Http\Requests\SolutionRequest;
use Auth;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Solution $solution, Request $request)
    {
		// 分页获取21条记录。默认获取15条
		$solutions = $solution->withOrder($request->order)->paginate(21);

		return view('pages.solution.index', compact('solutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Solution $solution)
    {
        $solutioncol = Solutioncol::all();
		return view('pages.solution.create_and_edit', compact('solution', 'solutionscol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolutionsRequest $request, Solution $solution)
    {
        $solution->fill($request->all());
		$solution->user_id = Auth::id();
		$solution->save();
		return redirect()->to($solution->link())->with('success', '成功创建话题！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Solution $solution)
    {
        // 如果话题带有slug翻译字段 强制使用带翻译字段的链接
        if ( ! empty($solution->slug) && $solution->slug != $request->slug) {
            return redirect($solution->link(), 301);
        }
        return view('pages.solution.show', compact('solution'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        $this->authorize('update', $solution);
		$solutionscol = Solutioncol::all();
		return view('pages.solution.create_and_edit', compact('solution','solutionscol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SolutionsRequest $request, Solution $solution)
    {
        $this->authorize('update', $solution);
		$solution->update($request->all());

		return redirect()->to($solution->link())->with('success', '话题更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        $this->authorize('destroy', $solution);
		$solution->delete();

		return redirect()->route('solution.index')->with('message', '删除成功.');
    }
}
