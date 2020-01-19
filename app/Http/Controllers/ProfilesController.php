<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        // dd($user);
        // dd(User::find($user));
        // $user = User::findOrFail($user);
        // 如果上面的index進來的變數已經有驗證過了，這邊就不用用上面那行去驗證了，但是台灣這邊的寫法好像比較流行上面的那種處理方法

        // return view('profile.index', [
        //     'user' => $user
        // ]);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // 傳到前台的變數區
        // 盡可能在後台把值算出來傳到前台去，可以講啲來回的query數，接著這樣的結構才能做cache哦
        // $postCount = $user->posts->count();
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profile.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profile.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user->profile);

        // dd(gettype($request['image']));
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);


        // dd($data);
        // $user->profile->update($data);

        // request('image')-file('image');

        if( request('image') )
        {
            // dd(request('image'));    //  因為之前沒有在form上面加上enctype="multipart/form-data"所以用來練習測試的東西
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        // dd($data);

        // dd(array_merge(
        //     $data,
        //     ['image' => $imagePath]
        // ));

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
