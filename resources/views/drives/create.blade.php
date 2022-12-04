@extends('layouts.app')

@section('content')
<div class="container">
<div class="card col-md-8">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card-body">


        <form method="POST" action="{{route('drives.store')}}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="title" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">description</label>
              <input type="text" class="form-control" name="description" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">file</label>
                <input type="file" class="form-control" name="file" id="exampleInputPassword1">
              </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>



    </div>

</div>

</div>


@endsection
