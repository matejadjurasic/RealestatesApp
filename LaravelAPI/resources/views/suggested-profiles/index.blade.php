@extends('layouts.app')

@section('content')
    <h1>Predlozeni profili</h1>

    @if($suggestedProfiles->isEmpty())
        <p>Nema predlozenih profila.</p>
    @else
        <ul>
            @foreach($suggestedProfiles as $profile)
                <li>
                    <strong>{{ $profile->username }}</strong>   
                    @if($profile->approval)
                        <span class="badge badge-success">Odobreno</span>
                    @else
                        <span class="badge badge-warning">Ceka na odobrenje...</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection