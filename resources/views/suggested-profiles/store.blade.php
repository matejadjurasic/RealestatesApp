@extends('layouts.app') {{-- Asumiramo da koristite osnovni layout --}}

@section('content')
    <div class="alert alert-success">
        <p>Hvala sto ste predlozili profil! Vas predlog je primljen.</p>
    </div>

    <a href="{{ route('suggested-profiles.index') }}" class="btn btn-primary">Vracanje na predlozene profile</a>
@endsection