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

    public function save_file($request, $name, $user)
    {
        $changed = false;
        if (! is_null($request->file('profile_image'))) {
            if (! is_null($user_profile_image = auth()->user()->profile_image) and File::exists(public_path("\\uploads\\imgs".$user_profile_image))) {
                File::delete(public_path('\\uploads\\imgs'.$user_profile_image));
            }
        $request->validate([$name => 'image']);
        $file = $request->file($name);
        $file_name = str_replace(":", "-", str_replace(" ", "-", now())) . $file->getClientOriginalName();
        $file->move(public_path('\\uploads\\imgs'), $file_name);
        $user->update(['profile_image' => $file_name]);
            $changed = true;
        }
        return $changed;
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
            'bio' => ['max:400']
        ]);

        $this->save_file($request, 'profile_image', $user);

        $medias = $this->convert_medias($request->social_media);

        $user->update([
            'name' => $validate_data['name'],
            'email' => $validate_data['email'],
            'username' => $validate_data['username']
        ]);
        $user->profile->update([
            'username' => $validate_data['username'],
            'social_media' => json_encode($medias),
            'bio' => $validate_data['bio']
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
        $bookmarks = [];
        $likes = [];

        if (auth()->check()){
            $bookmarks = auth()->user()->user_bookmarks->pluck('article_id')->toArray();
            $likes = auth()->user()->user_likes->pluck('article_id')->toArray();
        }

        $articles = $user->articles()->latest()->paginate(10);

        return view("main.profile", compact('articles', 'user', 'bookmarks', 'likes'));
    }

    protected function convert_medias($social_medias)
    {
        $json_medias = [];
        $medias = [
            "https://instagram.com/",
            "https://t.me/",
            "https://www.linkedin.com/in/",
            "https://github.com/",
        ];
        $medias_keys = ["instagram", 'telegram', 'linkedin', 'github'];
        foreach ($social_medias as $key=>$social_media) {
            if (is_null($social_media)) {
                continue;
            }
            $url = (str_contains($social_media,"/"))?($social_media):(($medias[$key].$social_media));
            $json_medias[$medias_keys[$key]] = $url;
        }

        return $json_medias;

    }
}
