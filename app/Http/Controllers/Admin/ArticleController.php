<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index']
        ]);
    }*/

    public function index()
    {

        $articles = Article::paginate(1);

        return view('Admin.article.list',compact('articles'));
    }

    public function create()
    {

        $users= User::all();
        return view('Admin.article.add',compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'author_id'=>'required',
            'publish_date'=>'required',
            'captcha'=>'required|captcha',

        ],
         [
            //错误信息展示
                'title.required'=>'文章标题不能为空',
                'content.required'=>'文章内容不能为空',
                'publish_date.required'=>'请填写创建时间',
                'captcha.required'=>'验证码不正确',
                'captcha.captcha'=>'验证码不正确'

            ]);
        //验证失败
        //return back()->withInput();
        //处理上传文件
        //$path = $request->file('cover')->store('public/articles');

        Article::create([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'author_id'=>$request->author_id,
            'publish_date'=>$request->publish_date,

        ]);


        //session()->flash('success','文章添加成功');

        return redirect()->route('articles.index')->with('success','添加成功');
    }
    //修改
    public function edit(Article $article)
    {
        //只能修改自己的文章
        if($article->author_id != Auth::user()->id){
            return response('不能 修改别人的文章',403);
        }
        //$this->authorize('update',$article);

        $admins = Admin::all();
        return view('Admin.article.edit',compact('article','admins'));
    }

    public function update(Article $article,Request $request)
    {
        $this->authorize('update',$article);
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'author_id'=>'required',
            'publish_date'=>'required',
        ]);

        $article->update([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'author_id'=>$request->author_id,
            'publish_date'=>$request->publish_date,
        ]);

        session()->flash('success','文章修改成功');

        return redirect()->route('Admin.articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('success','文章删除成功');

        return redirect()->route('articles.index');
    }

    public function show()
    {
//查看
    }
}
