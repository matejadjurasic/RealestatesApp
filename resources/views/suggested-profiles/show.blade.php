@extends('layouts.app')

@section('content')
    <h1>Detalji predlozenog profila</h1>

    @if($profile)
        <p><strong>Username:</strong> {{ $profile->username }}</p>
        <p><strong>Status:</strong>
            @if($profile->approval)
                <span class="badge badge-success">Odobreno</span>
            @else
                <span class="badge badge-warning">Ceka na odobrenje...</span>
            @endif
        </p>
        {{-- dodaj jos info --}}
    @else
        <p>Profil nije pronadjen.</p>
    @endif
@endsection