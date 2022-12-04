<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
public function goadmin(){
    return view('auth.loginAdmin');
}
public function dashboard(){
    return view("dashboard");
}
public function login(Request $request){
$request->validate([
"email"=>"required|email",
"password"=>"required"
]);


if(Auth::guard('admin')->attempt([
    "email"=>$request->email,
    "password"=>$request->password

])){
    return redirect('/dashboard');
}else{

return redirect()->route('admin.login');
}

}
}
