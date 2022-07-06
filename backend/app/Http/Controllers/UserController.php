<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function signin(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }

    public function login(Request $request){
        $user = User::Where('email', $request->email)->get();

        if($request->password == $user[0]->password){
            return json_encode($user);
        } else {
            abort(403, 'not login');
        }
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return json_encode($user);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = $request->password;
        }
        $user->save();
        return json_encode($user);
    }
}
