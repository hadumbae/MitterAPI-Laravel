<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Like;

class LikeAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'This is the Like Index.';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids = request()->only('user_id', 'tweet_id');

        $testCount = \DB::table('likes')->where('tweet_id','=',$ids['tweet_id'])->where('user_id','=',$ids['user_id'])->count();

        if($testCount > 0){
            $testCount = \DB::table('likes')->where('tweet_id','=',$ids['tweet_id'])->where('user_id','=',$ids['user_id'])->delete();
        }else {
            Like::create(['user_id' => $ids['user_id'], 'tweet_id' => $ids['tweet_id']]);
        }

        $likeCount = \DB::table('likes')->where('tweet_id', '=', $ids['tweet_id'])->count();

        if($likeCount > 0){
            return json_encode(true);
        }
        else{
            return json_encode(false);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function count($id)
    {
        $likesCount = \DB::table('likes')->where('tweet_id', '=', $id)->count();

        return $likesCount;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doILike(Request $request)
    {
        $data = request()->only('tweet_id', 'user_id');

        $like = \DB::table('likes')->where('tweet_id','=',$data['tweet_id'])->where('user_id','=',$data['user_id'])->count();

        if($like > 0){
            return json_encode(true);
        }
        else{
            return json_encode(false);
        }
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
