<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // dd($users);
        // $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        // $posts = Post::whereIn('user_id', $users)->latest()->get();
        // 上面兩行做的事情一樣，這個老師喜歡下面這行就用下面這行吧
        // dd($posts);
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // 用上面的paginate語法就可限制一次要顯示的文章數了
        // 這裡的with('user)講的是model裡面的public function user()
        // 會這樣調整跟telescope裡面的query有關，因為這樣query會變得比較單純也不用關聯來關聯去的所以比較單純
        // 原本的是         select * from "users" where "id" =? limit 1
        // 修改後會變成     select * from "users" where "users"."id" in (1)
        // 後面不用telescope的話清除相關東西的指令為php artisan telescope:clear
        // 清理以後telescope裡面的資料就只剩下你的delete那條就很乾淨囉

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    // public function store(Request $request)
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);

        // dd(request()->all());
        // return $request->all();
    }

    public function show(\App\Post $post)
    {
        // dd($post);
        return view('posts.show', compact('post'));
    }
}
