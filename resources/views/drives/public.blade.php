@extends('layouts.app')

@section('content')
<div class="container col-md-8" id="con">
<div class="card ">
    @if (Session::has('done'))
  <div class="alert alert-success col-md-6" role="alert">
{{Session::get('done')}}
      </div>
    @endif

    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">title</th>
                <th scope="col">download </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($data as $item )
                <tr>

                    <td> {{$item->id}}</td>
                    <td> {{$item->name}}</td>
                    <td>{{$item->title}}</td>
                  <td> <a href="{{route('drives.downlaod',$item->id)}}"><i class='bx bxs-cloud-download'  style="font-size: 30px;color: black;"></i></a></td>


                  </tr>
                @empty

                @endforelse


            </tbody>
          </table>

</div>

</div>


@endsection
