@extends('layouts.app') 

@section('content')
    <h1>Create Suggested Profile</h1>

    <form action="{{ route('suggested-profiles.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <!-- Dodajte dodatna polja prema potrebama -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection