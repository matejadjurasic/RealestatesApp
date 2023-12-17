@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="{{route('realestates.index')}}">Back</a><br>


@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops There were some problems with your input</strong><br><br>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('realestates.update',$estate->id)}}" method="POST">
    @csrf 
    @method('PUT')
    <Strong>Price:</Strong>
    <input type="text" name="price" value="{{$estate->price}}" placeholder="Price"><br>
    <Strong>Location:</Strong>
    <input type="text" name="location" value="{{$estate->location}}" placeholder="Location"><br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form action="{{route('realestates.updateapi',$estate->id)}}" method="POST">
    @csrf 
    @method('PUT')
    <button type="submit" class="btn btn-primary">Update API</button>
</form>

@endsection