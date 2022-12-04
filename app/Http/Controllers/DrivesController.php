<?php

namespace App\Http\Controllers;

use App\drives;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DrivesController extends Controller
{
    public function all_index(){
        $all=DB::table('users')->join('drives','users.id','=','drives.user_id')->where('status','=',2)->get();
        return view('drives.public',['data'=>$all]);

    }
    public function status(Request $request,$id){
        $data=drives::find($id);
        if($data->status==1){
        $data->status=2;
        $data->save();
        return redirect()->route('drives.public');}
        else{
            $data->status=1;
            $data->save();
            return redirect()->route('drives.public');
        }
    }
    public function index()
    {
        $id=Auth::user()->id;
        $all=drives::where('user_id','=',$id)->get();
       return view("drives.index",['data'=>$all]);
    }


    public function create()
    {
        return view("drives.create");
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'file'=>'required|file|max:1000'
        ]);

        $drive=new drives;
        $drive->title=$request->title;
        $drive->description=$request->description;
        $f=$request->file('file');
        $file_name=time(). $f->getClientOriginalName();

        $f->move(public_path('./drive/'),$file_name);
        $drive->file=$file_name;
        $user_id=Auth::user()->id;
        $drive->user_id=$user_id;
        $drive->save();
        return redirect()->route('drives.index')->with('done',"insert true");

    }

    public function show($id)
    {
        $data=drives::find($id);

        return view('drives.show',['data'=>$data]);

    }


    public function edit($id)
    {
        $data=drives::find($id);

        return view('drives.update',['data'=>$data]);

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',

        ]);
        $data=drives::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $data_file=$request->file('file');
        if( $data_file!=null){
            $d=public_path()."/drive/".$data->file;
            unlink($d);
        $file_name=time(). $data_file->getClientOriginalName();

        $data_file->move(public_path('./drive/'),$file_name);
        $data->file=$file_name;

        }else{

        }
        $data->save();
        return redirect()->route('drives.index')->with('done',"update true");

    }



    public function destroy($id)
    {
        $data=drives::find($id);
        $name=$data->file;
        $d=public_path()."/drive/".$name;

        unlink($d);
        $data->delete();
        return redirect()->route('drives.index')->with('done',"delete true");



    }
    public function download($id){
        $data=drives::find($id);
        $name=$data->file;
        $d=public_path()."/drive/".$name;
        return response()->download(($d));

    }
    public function goto(){
        return view('drives.401');
    }
}
