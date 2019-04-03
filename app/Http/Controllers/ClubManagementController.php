<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\News;
use App\Models\Category;
use App\Models\Productcol;
use App\Models\Solutioncol;
use App\Models\Customercol;
use App\Jobs\FormatTempArticles;
use Illuminate\Support\Facades\Log;

class ClubManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
     /**
      * 默认社区类目
      *
      * @return void
      */
    public function column()
    {
        $categorys = Category::all();
        return view('management.column',compact('categorys'));
    }
    /**
     * 获取产品 解决方案 客户案例类名
     *
     * @return void
     */
    public function columns(Request $request)
    {
        // 获取分类失败
        $data = [
            'code'=>1,
            'msg'=>'获取分类失败'
        ];
        if($request->type == 'productcol'){
            $data = Productcol::all();
        }else if($request->type == 'solutioncol'){
            $data = Solutioncol::all();
        }else if($request->type == 'customercol'){
            $data = Customercol::all();
        }else if($request->type == 'seo'){
            $data = DB::table('seos')->get();
        }else if($request->type == 'keywords'){
            //获取缓存的关键词
		    $data =  [];
		    $keys =  Redis::keys('keywords_*');
		    foreach ($keys as $key) {
                $word = [];
                $word['key'] = $key;
                $word['keywords'] = Redis::get($key);
		    	array_push($data,$word);
		    }
        }else if($request->type == 'file'){
            $data = DB::table('files')->get();
        }
        return $data;
    }
    public function system()
    {
			
        return view('management.system');
    }
    /**
     * 社区推荐管理
     *
     * @return void
     */
    public function recommend()
    {
        $clubbanners = \DB::table('settings')->where('key','club_banner')->get();
        return view('management.recommend',compact('clubbanners'));
    }
    public function recommendStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'保存失败！'];
        $data = $request->all();
        if($request->action == 'add'){
            $id = DB::table('settings')->insertGetId([
                'key'=>'club_banner',
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'created_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'新增成功！'];
        }else if($request->action == 'update'){
            DB::table('settings')->where('id', $request->id)->update([
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'updated_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'更新banner成功!'];
        }else if($request->action == 'delete'){
            DB::table('settings')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除banner成功!'];
        }
        Cache::forget('club_banner');
        return $res;
    }
    /**
     * 主站推荐管理
     *
     * @return void
     */
    public function webRecommend()
    {
        $solutionbanners = \DB::table('settings')->where('key','solution_banner')->get();
        $homebanners = \DB::table('settings')->where('key','home_banner')->get();
        $loginbanners = \DB::table('settings')->where('key','login_banner')->get();
        return view('management.web_recommend',compact('homebanners','solutionbanners','loginbanners'));
    }
    public function webRecommendStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'保存失败！'];
        $data = $request->all();
        if($request->action == 'add'){
            $id = DB::table('settings')->insertGetId([
                'key'=>'home_banner',
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'icon1'=>$request->icon1,
                'icon_title1'=>$request->icon_title1,
                'icon_link1'=>$request->icon_link1,
                'icon2'=>$request->icon2,
                'icon_title2'=>$request->icon_title2,
                'icon_link2'=>$request->icon_link2,
                'icon3'=>$request->icon3,
                'icon_title3'=>$request->icon_title3,
                'icon_link3'=>$request->icon_link3,
                'icon4'=>$request->icon4,
                'icon_title4'=>$request->icon_title4,
                'icon_link4'=>$request->icon_link4,
                'icon5'=>$request->icon5,
                'icon_title5'=>$request->icon_title5,
                'icon_link5'=>$request->icon_link5,
                'created_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'新增成功！'];
        }else if($request->action == 'update'){
            DB::table('settings')->where('id', $request->id)->update([
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'icon1'=>$request->icon1,
                'icon_title1'=>$request->icon_title1,
                'icon_link1'=>$request->icon_link1,
                'icon2'=>$request->icon2,
                'icon_title2'=>$request->icon_title2,
                'icon_link2'=>$request->icon_link2,
                'icon3'=>$request->icon3,
                'icon_title3'=>$request->icon_title3,
                'icon_link3'=>$request->icon_link3,
                'icon4'=>$request->icon4,
                'icon_title4'=>$request->icon_title4,
                'icon_link4'=>$request->icon_link4,
                'icon5'=>$request->icon5,
                'icon_title5'=>$request->icon_title5,
                'icon_link5'=>$request->icon_link5,
                'updated_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'更新banner成功!'];
        }else if($request->action == 'delete'){
            DB::table('settings')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除banner成功!'];
        }
        Cache::forget('home_banner');
        return $res;
    }
    public function webSolutionStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'保存失败！'];
        $data = $request->all();
        if($request->action == 'add'){
            $id = DB::table('settings')->insertGetId([
                'key'=>'solution_banner',
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'icon1'=>$request->icon1,
                'created_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'新增成功！'];
        }else if($request->action == 'update'){
            DB::table('settings')->where('id', $request->id)->update([
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'icon1'=>$request->icon1,
                'updated_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'更新banner成功!'];
        }else if($request->action == 'delete'){
            DB::table('settings')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除banner成功!'];
        }
        Cache::forget('solution_banner');
        return $res;
    }
    public function webloginStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'保存失败！'];
        $data = $request->all();
        if($request->action == 'add'){
            $id = DB::table('settings')->insertGetId([
                'key'=>'login_banner',
                'link'=>$request->link,
                'banner'=>$request->banner,
                'created_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'新增成功！'];
        }else if($request->action == 'update'){
            DB::table('settings')->where('id', $request->id)->update([
                'link'=>$request->link,
                'banner'=>$request->banner,
                'updated_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'更新banner成功!'];
        }else if($request->action == 'delete'){
            DB::table('settings')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除banner成功!'];
        }
        Cache::forget('login_banner');
        return $res;
    }
    /**
     * 添加 更新SEO 城市名称
     *
     * @return void
     */
    public function seoStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'操作失败!'];
        if($request->id){
            DB::table('seos')->where('id', $request->id)->update($request->all());
            $res = ['code'=>0,'msg'=>'更新城市成功!'];
        }else{
            $id = DB::table('seos')->insertGetId($request->all());
            $res = ['code'=>0,'msg'=>'新增城市成功!'];
        }
        Cache::forget('soe_citys');
        return $res;
    }
    /**
     * 删除SEO城市
     *
     * @return void
     */
    public function seoDestroy(Request $request)
    {
        $res = ['code'=>1,'msg'=>'删除城市失败!'];
        if($request->id){
            DB::table('seos')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除城市成功!'];
        }
        Cache::forget('soe_citys');
        return $res;
    }
    /**
     * 添加 更新keywords关键词
     *
     * @return void
     */
    public function keywordsStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'操作失败!'];
        if($request->keywords){
            $keywords = $request->keywords;
            $keywords = str_replace("，",",",$keywords); 
            $keywords = str_replace(" ","",$keywords);
            $keywords = trim($keywords,",");
            $keywords = explode(",",$keywords);
            foreach ($keywords as $word) {
                // 关键词默认保存90天，过期后自动删除
                Redis::setex("keywords_".str_random(10),60*60*24*90,$word);
            }
            $res = ['code'=>0,'msg'=>"新增".count($keywords)."个关键词成功!"];
        }
        return $res;
    }
    /**
     * 删除keywords关键词
     *
     * @return void
     */
    public function keywordsDestroy(Request $request)
    {
        $res = ['code'=>1,'msg'=>'删除关键词失败!'];
        if($request->key){
            Redis::del($request->key);
            $res = ['code'=>0,'msg'=>'删除关键词成功!'];
        }
        return $res;
    }
    /**
     * 后台批量展示用户
     *
     * @return void
     */
    public function users(Request $request, User $user){
        if($request->phone){
            $users = User::where('phone',$request->phone)->paginate(1);
        }else{
            $users = User::paginate(8);
        }
        return view('management.users',compact('users'));
    }
    /**
     * 修改用户
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function userstore(Request $request, User $user)
    {
        $data = $request->all();
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $user = User::find($data['id']);
        $user->fill($data);
        if($data['activated'] == '1'){
            $user->activated = true;
        }else{
            $user->activated = false;
        }
        $user->save();
        $res = [
            'code'=>0,
            'msg'=>'用户信息修改成功！'
        ];
        return $res;
    }
    /**
     * 展示所有角色
     *
     * @param Role $role
     * @return void
     */
    public function roles(Role $role)
    {
        $roles = Role::paginate(10);
        return view('management.roles',compact('roles'));
    }
    public function roleStore(Request $request, Role $role)
    {
        $res = [
            'code'=>1,
            'msg'=>'操作失败！'
        ];
        if($request->id){
            $role->where('id',$request->id)
                ->update($request->all());
            $res = [
                'code'=>0,
                'msg'=>'操修改角色成功！'
            ];
        }else{
            $role->fill($request->all());
            $role->save();
            $res = [
                'code'=>0,
                'msg'=>'创建角色成功！'
            ];
        }
        return $res;
    }
    /**
     * 展示所有权限
     *
     * @param Role $role
     * @return void
     */
    public function permissions(Permission $permission)
    {
        $permissions = Permission::all();
        return $permissions;
    }
    /**
     * 展示拥有角色的用户
     *
     * @return void
     */
    public function roleusers(Request $request, Role $role)
    {
        // 获取角色所有用户
        $users = User::role($request->id)->get(); 
        return $users;
    }
    /**
     * 获得角色所拥有的权限
     *
     * @param Request $request
     * @param Role $role
     * @return void
     */
    public function rolepermission(Request $request, Role $role)
    {
        // 获取所有角色拥有的所有权限
        $role = Role::find($request->id);
        $permissions = $role->permissions;
        return $permissions;
    }
    
    /**
     * 角色添加/删除用户，角色添加删除权限
     *
     * @return void
     */
    public function userandpermission(Request $request, Role $role, Permission $permission, User $user)
    {
        $data = [
            'code' => 1,
            'msg' => '操作失败！',
        ];
        $role = Role::find($request->roleid);
        if($request->type == 'user'){
            $user = User::find($request->userid);
            if($request->action == 'delete'){
                $user->removeRole($role);
                $data = [
                    'code' => 0,
                    'msg' => '移除用户成功！',
                ];
            }else if($request->action == 'add'){
                $user->assignRole($role);
                $data = [
                    'code' => 0,
                    'msg' => '添加用户成功！',
                ];
            }
        }else if($request->type == 'permission'){
            // 得到权限
            $permissions = $request->permissionid;
            if(is_array($permissions)){
                $permissions = array_keys($permissions);
            };
            $permission = Permission::find($permissions);
            if($request->action == 'delete'){
                $role->revokePermissionTo($permission);
                $data = [
                    'code' => 0,
                    'msg' => '移除权限成功！',
                ];
            }else if($request->action == 'add'){
                $role->givePermissionTo($permission);
                $data = [
                    'code' => 0,
                    'msg' => '添加权限成功！',
                ];
            }
        }
        return $data;
    }
    public function settings()
    {
        $advertisings = \DB::table('settings')->where('key','side_advertising')->get();
        //反序列号 得到广告列表
        return view('management.settings',compact('advertisings'));
    }
    public function settingsStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'保存失败！'];
        $data = $request->all();
        if($request->action == 'add'){
            $id = DB::table('settings')->insertGetId([
                'key'=>'side_advertising',
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'created_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'新增成功！'];
        }else if($request->action == 'update'){
            DB::table('settings')->where('id', $request->id)->update([
                'link'=>$request->link,
                'banner'=>$request->banner,
                'title'=>$request->title,
                'updated_at'=>Carbon::now(),
                ]);
            $res = ['code'=>0,'msg'=>'更新广告成功!'];
        }else if($request->action == 'delete'){
            DB::table('settings')->where('id', $request->id)->delete();
            $res = ['code'=>0,'msg'=>'删除广告成功!'];
        }
        Cache::forget('side_advertising');
        return $res;
    }
    // QQ客服
    public function onlineService(Request $request)
    {
        Cache::forever('online_service', $request->qq);
        //反序列号 得到广告列表
        return back()->with('success', '客服QQ保存成功');
    }

    // 数据导入展示
    public function loads()
    {
        $temparticles = DB::table('temparticle')->paginate(100);
        $send_jobs = [];
        $send_jobs['topics_set']= Redis::scard("topics_set");
        $send_jobs['news_2_set']= Redis::scard("news_2_set");
        $send_jobs['news_3_set']= Redis::scard("news_3_set");
        //数据导入表格
        return view('management.loads',compact('temparticles','send_jobs'));
    }     
    // 数据预览修改
    public function loadStore(Request $request)
    {
        $res = ['code'=>1,'msg'=>'操作失败!'];
        if($request->action == 'view'){
            $res['code'] = 0;
            $res['msg'] = '操作成功!';
            $data = DB::table('temparticle')->where('id',$request->id)->first();
            $res['data'] = $data;
        }else if($request->action == 'delete'){
            if($request->list){
                DB::table('temparticle')->whereIn('id', $request->list)->delete();
            }else{
                DB::table('temparticle')->where('id', $request->id)->delete();
            }
            $res['code'] = 0;
            $res['msg'] = '删除成功!';
        }
        return $res; 
    }
    
    // 格式化文章，下载图片到本地，删除特殊字符
    public function loadformat(Request $request)
    {
        $count = 0;
        foreach ($request->list as $article) {
            if(!$article['format']){
                dispatch(new FormatTempArticles($article['id']));
                $count++;
            }
        }
        return $res = ['code'=>0,'msg'=>$count.'条数据处理中...'];
    }
    // 发布文章
    public function loadSend(Request $request,User $user)
    {
        $count = 0;
        if($request->type == "topics"){
            foreach ($request->list as $item) {
                if($request->nowSend == "true"){
                    $article = \DB::table('temparticle')->where('id',$item['id'])->first();
                    $topic = new Topic;
                    $topic->category_id= getCategory($article->category);
                    $topic->title = $article->category."|".$article->title;
                    $topic->body = $article->body;
                    $topic->source = $article->source;
                    // 随机取2-61ID的机器人用户
		            $topic->user_id = $user->find(mt_rand(2,10))->id;
                    $topic->save();
                    // 最多保存6条回复
                    if($article->reply1 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply1;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    if($article->reply2 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply2;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    if($article->reply3 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply3;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    if($article->reply4 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply4;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    if($article->reply5 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply5;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    if($article->reply6 != ""){
                        $reply = new Reply;
                        $reply->content = $article->reply6;
                        $reply->user_id = $user->find(mt_rand(2,10))->id;
                        $reply->topic_id = $topic->id;
                        $reply->save();
                    }
                    $count++;
                    // 删除已发布的临时文章
                    \DB::table('temparticle')->where('id',$item['id'])->delete();
                }else if($item['format']){
                    // 将文章ID放入redis集合中
                    if(!Redis::sismember("topics_set",$item["id"])){
                        Redis::sadd("topics_set",$item["id"]);
                        $count++;
                    }
                }
            }
            return $res = ['code'=>0,'msg'=>$count.'条数据已处理完毕...'];
        }else if($request->type == "news-hy"){
            foreach ($request->list as $item) {
                if($request->nowSend == "true"){
                    $article = \DB::table('temparticle')->where('id',$item['id'])->first();
                    $news = new News;
                    $news->column_id= 2;
                    $news->title = $article->title;
                    $news->keywords = $article->title;
                    $news->image = $article->image;
                    $news->body = $article->body;
                    $news->source = $article->source;
                    // 随机取2-61ID的机器人用户
		            $news->user_id = $user->find(mt_rand(2,10))->id;
                    $news->save();
                    $count++;
                    // 删除已发布的临时文章
                    \DB::table('temparticle')->where('id',$item['id'])->delete();
                    $count++;
                }else if($item['format']){
                    // 将文章ID放入redis集合中
                    if(!Redis::sismember("news_2_set",$item["id"])){
                        Redis::sadd("news_2_set",$item["id"]);
                        $count++;
                    }
                }
            }
            return $res = ['code'=>0,'msg'=>$count.'条数据处理中...','data'=>$request->all()];
        }else if($request->type == "news-zhik"){
            foreach ($request->list as $item) {
                if($request->nowSend == "true"){
                    $article = \DB::table('temparticle')->where('id',$item['id'])->first();
                    $news = new News;
                    $news->column_id= 3;
                    $news->title = $article->title;
                    $news->keywords = $article->title;
                    $news->image = $article->image;
                    $news->body = $article->body;
                    $news->source = $article->source;
                    // 随机取2-61ID的机器人用户
		            $news->user_id = $user->find(mt_rand(2,10))->id;
                    $news->save();
                    $count++;
                    // 删除已发布的临时文章
                    \DB::table('temparticle')->where('id',$item['id'])->delete();
                    $count++;
                }else if($item['format']){
                    // 将文章ID放入redis集合中
                    if(!Redis::sismember("news_3_set",$item["id"])){
                        Redis::sadd("news_3_set",$item["id"]);
                        $count++;
                    }
                }
            }
            return $res = ['code'=>0,'msg'=>$count.'条数据处理中...','data'=>$request->all()];
        }
        
        return $res = ['code'=>1,'msg'=>'遇到错误,'.$count.'条数据被发布。'];
    }   

}
