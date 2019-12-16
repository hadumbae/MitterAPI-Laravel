<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Follow;
use App\Tweet;


class FollowAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "This is the Follow Index.";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $data = request()->only('target_id', 'follower_id');

        $follow = \DB::table('follows')->where('target_id','=',$data['target_id'])->where('follower_id','=',$data['follower_id'])->get();

        if($follow == '[]'){
            $newFollow = Follow::create([
                'target_id' => $data['target_id'],
                'follower_id' => $data['follower_id'],
            ]);

            return 'true';
        }
        else {
            \DB::table('follows')->where('target_id','=',$data['target_id'])->where('follower_id','=',$data['follower_id'])->delete();
            return "false";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tweetFollow($id)
    {
        $iFollowList = Follow::where('follower_id', '=', $id)->get();
        $targetList = [];

        foreach ($iFollowList as $target) {
            array_push($targetList, $target->target_id);
        }

        array_push($targetList, $id);

        $myList = Tweet::whereIn('user_id', $targetList)->orderBy('created_at', 'desc')->get();

        if($myList == '[]'){
            return 'null';
        }

        return $myList;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function iFollow($id)
    {
        $myList = \DB::table('follows')->where('follower_id','=', $id)->get();
        return $myList;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myFollow($id)
    {
        // $myList = \DB::table('follows')->select('follower_id')->where('target_id','=', $id)->get();
        // $follow = [];
        // foreach ($myList as $follower) {
        //     array_push($follow, $follower->follower_id);
        // }

        $myList = \DB::table('follows')->where('target_id','=', $id)->get();
        return $myList;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function followCount($id)
    {
        $myCount = \DB::table('follows')->where('target_id','=', $id)->count();
        return $myCount;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doIFollow(Request $request)
    {
        $data = request()->only('target_id', 'follower_id');

        $follow = \DB::table('follows')->where('target_id','=',$data['target_id'])->where('follower_id','=',$data['follower_id'])->get();

        if($follow == '[]'){
            return json_encode(false);
        }
        else{
            return json_encode(true);
        }
    }
}
