<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\drives;

class DrivesController extends Controller
{

    public function index()
    {
        $data=drives::all();
        $mesage=[
            "data"=>$data,
            "message"=>"sellect sessuful"
        ];

       return response($mesage,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $request->validate([
            'title'=>'required',
            'description'=>'required',
            "file"=>"required"

           ]);


           $file=$request->file('file');
           if($request->hasFile('file')){
            $file_name=time(). $file->getClientOriginalName();
            $file->move(public_path().'/drive/',$file_name);
           }
          $drive= drives::create([
            "title"=>$request->title,
            "description"=>$request->description,
            "file"=>$file_name,
            "user_id"=>$request->user_id,
            "status"=>$request->status


           ]);
           $message=[
            "data"=>$drive,
            "message"=>"sussfull insert",
            "status"=>"200"

           ];
           return response($message,200);


    }


    public function show($id)
    {
       $drive=drives::find($id);
       $message=[
        "data"=>$drive,
        "message"=>"show drive true"
       ];
       return response($message,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
       $drives=drives::find($id);
       $drives->title=$request->title;
       $drives->description=$request->description;
       $file=$request->file('file');
       if($request->hasFile('file')){

        $file_name=time(). $file->getClientOriginalName();
        $file->move(public_path().'/drive/',$file_name);
        $drives->file=$file_name;

       }
       $drives->save();
       $message=[
        "data"=>$drives,
        "message"=>"sussfull update",
        "status"=>"200"

       ];
       return response($message,200);



    }

    public function destroy($id)
    {
       $drives=drives::destroy($id);
    
       $message=[

        "message"=>"sussfull delete",
        "status"=>"200"

       ];
       return response($message,200);

    }
}
