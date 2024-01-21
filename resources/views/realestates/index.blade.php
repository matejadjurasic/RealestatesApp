@extends('layouts.app')

@section('content')

<a class="btn btn-success" href="{{route('realestates.create')}}">Create RealEstate</a>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
@endif


@if (session('failure'))
    <div class="alert alert-danger">
        <p>{{session('failure')}}</p>
    </div>
@endif

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Location</th>
        <th width="280px">Action</th>
    </tr>
    @foreach($estates as $estate)
    <tr>
        <td>{{$estate->id}}</td>
        <td>{{$estate->username}}</td>
        <td>{{$estate->location}}</td>
        <td>
            <form action="{{route('realestates.destroy',$estate->id)}}" method="POST">
                <a class="btn btn-info" href="{{route('realestates.show',$estate->id)}}">Show</a>
                <a class="btn btn-primary" href="{{route('realestates.edit',$estate->id)}}">Edit</a>
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </td>
        <td>
            @if(auth()->check())
                 @if(auth()->user()->favoriteProfiles->contains('realestate_id', $estate->id))
                    <form method="POST" action="{{ route('favorites.remove', $estate->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove from Favorites</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('favorites.add', $estate->id) }}">
                        @csrf
                        <button type="submit">Add to Favorites</button>
                    </form>
                @endif
            @else
                
            @endif
        </td>
    </tr>
    @endforeach
</table>
   {{$estates->links()}}
@endsection