<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use  \Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('update',$user);

        return view('main.profile_edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate_data = $request->validate([
            'username' => ['required', 'string', 'max:255','alpha_dash','regex:/^[a-zA-Z0-9._]+$/i'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::notIn(User::whereNot("id", auth()->id())->get()->pluck("email"))],
            'bio' => ['max:600']
        ]);



        if (! is_null($request->file('profile_image'))) {
            if (! is_null($user_profile_image = $user->profile_image) and File::exists(public_path("\\uploads\\imgs".$user_profile_image))) {
                File::delete(public_path('\\uploads\\imgs'.$user_profile_image));
            }
            $request->validate(['profile_image' => 'image']);
            $file = $request->file('profile_image');
            $file_name = str_replace(":", "-", str_replace(" ", "-", now())) . $file->getClientOriginalName();
            $file->move(public_path('\\uploads\\imgs'), $file_name);
            $user->update(['profile_image' => $file_name]);
        }

        $medias = [
            "https://instagram.com/",
            "https://t.me/",
            "https://www.linkedin.com/in/",
            "https://github.com/",
        ];
        $medias_keys = ["instagram", 'telegram', 'linkedin', 'github'];

        $social_medias = $request->social_media;
        $json_medias = [];
        foreach ($social_medias as $key=>$social_media) {
            if (is_null($social_media)) {
                continue;
            }
            $url = (str_contains($social_media,"/"))?($social_media):(($medias[$key].$social_media));
            $json_medias[$medias_keys[$key]] = $url;
        }
        $user->update([
            'name' => $validate_data['name'],
            'email' => $validate_data['email'],
            'username' => $validate_data['username']
        ]);
        $user->profile->update([
            'username' => $validate_data['username'],
            'social_media' => json_encode($json_medias)
        ]);

        return Redirect::route("user.profile", $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function articles(User $user)
    {
        $articles = $user->articles()->latest()->paginate(10);

        return view('main.home', compact('articles'));
    }

    public function profile(User $user)
    {
        if (auth()->check()){
            $bookmarks = auth()->user()->user_bookmarks->pluck('article_id')->toArray();
            $likes = auth()->user()->user_likes->pluck('article_id')->toArray();
        } else{
            $bookmarks = [];
            $likes = [];
        }
        $articles = $user->articles()->latest()->paginate(10);
        return view("main.profile", compact('articles', 'user', 'bookmarks', 'likes'));
    }
}
