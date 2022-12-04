<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $filed=$request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|confirmed'

        ]);
        $user=User::create([
            'name'=>$filed['name'],
            'email'=>$filed['email'],
            'password'=>bcrypt($filed['password'])

        ]);
        $token=$user->createToken('mytoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,200);


    }
    public function login(Request $request){
        $filed=$request->validate([

            'email'=>'required',
            'password'=>'required'

        ]);
        $user=User::where('email','=',$filed['email'])->first();

        if(! $user|| ! Hash::check($filed['password'],$user->password)){
            return response("please enter right email or password",401);
        }
        $token=$user->createToken('mytoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,200);




    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return[
            'message'=>"log out true"
        ];
    }
}
