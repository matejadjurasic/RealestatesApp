@extends('layouts.app')

@section('content')

<h2>Add New RealEstate</h2>
<div class="pull-right">
    <a class="btn btn-primary" href="{{route('realestates.index')}}">Back</a>
</div>

@if (session('failure'))
    <div class="alert alert-danger">
        <p>{{session('failure')}}</p>
    </div>
@endif

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

<form action="{{route('realestates.store')}}" method="POST">
    @csrf 

    <Strong>Username:</Strong>
    <input type="text" name="name" placeholder="Username"><br>
    <Strong>Price:</Strong>
    <input type="text" name="price" placeholder="Price"><br>
    <Strong>Location:</Strong>
    <input type="text" name="location" placeholder="Location"><br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection