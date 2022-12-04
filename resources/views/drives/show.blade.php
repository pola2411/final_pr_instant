@extends('layouts.app')

@section('content')
<div class="container">
<div class="card col-md-8">
    @if (Session::has('done'))
  <div class="alert alert-success col-md-6" role="alert">
{{Session::get('done')}}
      </div>
    @endif

    <div class="card-body">
      <h1>{{$data->id}}</h1>
      <h1>{{$data->title}}</h1>
      <h1>{{$data->description}}</h1>
      <h1>{{$data->file}}</h1>
      <a href="{{route('drives.edit',$data->id)}}"><i class='bx bx-edit-alt'  style="font-size: 30px;color: black;"></i></a>
      <a href="{{route("drives.destroy",$data->id)}}"><i class='bx bx-message-alt-x'  style="font-size: 30px;color: black;"></i></a>
      <a href="{{route('drives.downlaod',$data->id)}}"><i class='bx bxs-cloud-download'  style="font-size: 30px;color: black;"></i></a>

</div>

</div>


@endsection
