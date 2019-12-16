<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "REGISTER API REACHED";
    }

    public function create(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = Validator::make($request->only('name', 'email', 'password', 'handle', 'bio'), [
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:6',
            'handle' => 'required|string|min:6|max:30',
            'bio' => 'required|string|min:6|max:225'
        ]);

        if ($valid->fails()) {
            $errors = $valid->errors();
            return $errors->toJson();
        }

        $data = request()->only('name', 'email', 'password', 'handle', 'bio');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'handle' => $data['handle'],
            'bio' => $data['bio'],
            'avatar' => "https://mitlav.linsenmiao.me/storage/tweetImages/igAkI8nc9aICRW0nzx8NemEo8aR9kCxR3oukTLCN.png",
            'cover' => "https://mitlav.linsenmiao.me/storage/tweetImages/XtqAsR9HKx0mavX9L1FNHTEiDBfQeSvDHH0hVNQa.jpeg",
            'type' => "U",
            'status' => "N",
        ]);

        $currentUser = User::latest()->first();

        $token = $currentUser->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'user' => $currentUser,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $data = request()->only('email', 'password');

        $username = $data['email'];
        $password = $data['password'];

        $user = User::select('*')->where('email', '=', $username)->where('password', '=', $password)->first();


        if($user == []){
            return '{
                "error" : "Error. Incorrect Credentials. Please try again."
            }';
        }
        else{
            $currentUser = $user;

            $token = $currentUser->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'user' => $currentUser,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        }
    }
}
