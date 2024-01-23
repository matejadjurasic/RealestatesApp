<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuggestedProfile;

class SuggestedProfileController extends Controller
{

    //preko compact se prosledjuju podaci do viewa

    public function index()
    {
        $suggestedProfiles = SuggestedProfile::all();
        //return view('suggested-profiles.index', compact('suggestedProfiles'));
        return response()->json($suggestedProfiles, 200, [], JSON_PRETTY_PRINT);
    }

    public function show($profileId)
    {
        $profile = SuggestedProfile::find($profileId);
        //return view('suggested-profiles.show', compact('profile'));
        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

    public function approveProfile($profileId)
    {
        $profile = SuggestedProfile::find($profileId);

        if ($profile) {
            $profile->update(['approval' => true]);
        }

        //return redirect()->route('suggested-profiles.index');
        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

    public function rejectProfile($profileId)
    {
        $profile = SuggestedProfile::find($profileId);

        if ($profile) {
            $profile->update(['approval' => false]);
        }

        //return redirect()->route('suggested-profiles.index');
        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

    public function create()
    {
        return view('suggested-profiles.create');
    }

    public function store(Request $request)
    {
         
        SuggestedProfile::create([
            //'id' => $request->input('id'),
            //'username' => $request->input('username'),
            'username' => $request->username,
            'user_id'=> $request->user_id
        ]);

        $profile = SuggestedProfile::orderBy('id', 'DESC')->first();

        //return redirect()->route('suggested-profiles.index');
        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

}
