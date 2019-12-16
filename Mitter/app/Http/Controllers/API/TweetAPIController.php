<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tweet;

class TweetAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'This is the Tweet Index.';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->only('content', 'user_id'), [
            'content' => 'required|string|max:225',
            'user_id' => 'required',
        ]);

        if($valid->fails()) {
            $errors = $valid->errors();
            return $errors->toJson();
        }

        $data = request()->only('content', 'user_id');

        $Tweet = Tweet::create([
            'content' => $data['content'],
            'user_id' => $data['user_id']
        ]);

        return $Tweet;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
        $tweetCount = \DB::table('tweets')->where('user_id','=', $id)->orderBy('created_at', 'desc')->count();

        if($tweetCount > 0) {
            $tweetList = \DB::table('tweets')->where('user_id','=', $id)->orderBy('created_at', 'desc')->get();
            return $tweetList;
        }
        else{
            return 'false';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::find($id);
        return $tweet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('tweets')->where('id','=', $id)->delete();
    }
}
