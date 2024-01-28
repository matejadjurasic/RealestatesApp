@extends('layouts.app')

@section('content')

    <a class="btn btn-primary" href="{{route('realestates.index')}}">Back</a><br>

    <div>
        <Strong>Username</Strong>
        {{$estate->username}}
        {{ $estate->id }}
    </div>
  


@endsection