<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\createRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\userResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Psy\Util\Str;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
//        dd(auth()->guard('api')->user());
        $users = User::all();
//        $data['foo']='bar';
//        foreach ($data as $key=>$item){
//            $item['username']=$item['name'];
//            dd($item['username']);
//            unset($item['name']);
//        }
//        dd($item);

        $users = new userResourceCollection($users->load('articles'));
//        dd($users);
        return $users;
//        return User::get();
    }

    public function user(Request $request, $id)
    {
        $user = User::findOrFail($id);
//        dd($user);
//        UserResource::withoutWrapping();
//        UserResource::$wrap = 'test';
//        $user->load('users');
        $user = new UserResource($user->load('articles'));
//        dd($user);
        return $user;
    }

    public function create(createRequest $request)
    {
//        $data=$request->all();
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'token' => \Illuminate\Support\Str::random(10),
        ]);
        return response($user, 201);
    }

    public function update(LoginRequest $request, $userId)
    {
        $user = User::findOrFail($userId);
//        $password=bcrypt($request->password);
//        $data=$request->only(['name']);
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response($user, 202);
    }

    public function delete(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return response([null], 204);
    }
}
