<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "This is the User Index.";
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
        $user = \DB::table('users')->where('id','=', $id)->get();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valid = Validator::make($request->only('name', 'password', 'handle', 'bio'), [
            'name' => 'required|string|max:225',
            'password' => 'required|string|min:6',
            'handle' => 'required|string|min:6|max:30',
            'bio' => 'required|string|min:6|max:225'
        ]);

        if ($valid->fails()) {
            $errors = $valid->errors();
            return $errors->toJson();
        }

        $data = request()->only('id', 'name', 'email', 'password', 'handle', 'bio');

        $user = User::find($data['id']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->handle = $data['handle'];
        $user->bio = $data['bio'];

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($handle)
    {
        $users = \DB::table('users')->where('handle','like','%'.$handle.'%')->orWhere('name','like','%'.$handle.'%')->get();
        $count = \DB::table('users')->where('handle','like','%'.$handle.'%')->orWhere('name','like','%'.$handle.'%')->count();

        if($count > 0){
            return $users;
        }
        else{
            return 'false';
        }
    }
}
