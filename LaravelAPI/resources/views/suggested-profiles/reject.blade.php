@extends('layouts.app') {{-- Asumiramo da koristite osnovni layout --}}

@section('content')
    <h1>Odbijanje predlozenog profila</h1>

    @if($profile)
        <p><strong>Username:</strong> {{ $profile->username }}</p>
        <p><strong>Status:</strong>
            @if($profile->approval)
                <span class="badge badge-success">Neodobreno</span>
            @else
                <span class="badge badge-warning">Ceka na odobrenje...</span>
            @endif
        </p>
        
        <form action="{{ route('suggested-profiles.reject', $profile->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Odbij profil</button>
        </form>
    @else
        <p>Profil nije pronadjen.</p>
    @endif
@endsection