<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Reply;

class ReplyAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "This is the Reply Index.";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $valid = Validator::make($request->only('content', 'tweet_id', 'user_id'), [
            'content' => 'required|string|max:225',
            'tweet_id' => 'required',
            'user_id' => 'required',
        ]);

        if($valid->fails()) {
            $errors = $valid->errors();
            return $errors->toJson();
        }

        $data = request()->only('content', 'tweet_id', 'user_id');

        $reply = Reply::create([
            'content' => $data['content'],
            'tweet_id' => $data['tweet_id'],
            'user_id' => $data['user_id']
        ]);

        return $reply;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $replies = \DB::table('replies')->where('tweet_id', '=', $id)->orderBy('created_at', 'desc')->get();

        return $replies;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOne($id)
    {
        $reply = \DB::table('replies')->where('id', '=', $id)->get();

        return $reply;
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
        \DB::table('replies')->where('id', '=', $id)->delete();

        return "Deleted.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function countReply($id)
    {
        $count = \DB::table('replies')->where('tweet_id', '=', $id)->count();

        return $count;
    }
}
