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
                <th scope="col">title</th>
                <th scope="col">show </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($data as $item )
                <tr>

                    <td> {{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td><a href="{{route('drives.show',$item->id)}}"><i class='bx bx-show-alt' style="font-size: 30px;color: black;"></i></a></td>
                   @if ($item->status==1)
            <td><a href="{{route('drives.status',$item->id)}}"><i class='bx bxs-share' style="font-size: 30px;color: black;"></i></a></td>
                    @else
                    <td><a href="{{route('drives.status',$item->id)}}"><i class='bx bx-lock-alt'style="font-size: 30px;color: black;"></i></a></td>



@endif
                </tr>
                @empty

                @endforelse


            </tbody>
          </table>

</div>

</div>


@endsection
