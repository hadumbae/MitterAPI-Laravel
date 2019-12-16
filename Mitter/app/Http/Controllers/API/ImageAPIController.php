<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\User;
use App\Tweet;

class ImageAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "This is the Image Index.";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tweetImage(Request $request)
    {
        $path = $request->file('imageFile')->store('public/tweetImages');
        $realPath = 'https://mitlav.linsenmiao.me/storage/' . substr($path, 7);

        $tweet  = Tweet::latest()->first();
        $tID = $tweet->id + 1;

        // $image = Image::create([
        //     'path' => $realPath,
        //     'tweet_id' => $tID
        // ]);

        $image = new Image;
        $image->path = $realPath;
        $image->tweet_id = $tID;
        $image->save();

        return $image;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function avatarImage(Request $request, $id)
    {

        $path = $request->file('imageFile')->store('public/tweetImages');
        $realPath = 'https://mitlav.linsenmiao.me/storage/' . substr($path, 7);

        $user = User::find($id);
        $user->avatar = $realPath;
        $user->save();

        return $realPath;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function headerImage(Request $request, $id)
    {

        $path = $request->file('imageFile')->store('public/tweetImages');
        $realPath = 'https://mitlav.linsenmiao.me/storage/' . substr($path, 7);

        $user = User::find($id);
        $user->cover = $realPath;
        $user->save();

        return $realPath;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAvatar($id)
    {
        $user = User::find($id);
        return $user->avatar;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getHeader($id)
    {
        $user = User::find($id);
        return $user->cover;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getImage($id)
    {
        $image = Image::where('tweet_id', $id)->get();
        return $image;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
