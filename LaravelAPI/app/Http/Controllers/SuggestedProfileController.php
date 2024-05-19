<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuggestedProfile;

class SuggestedProfileController extends Controller
{
    /**
     * Shows the listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestedProfiles = SuggestedProfile::all();

        return response()->json($suggestedProfiles, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Shows the specified resource.
     *
     * @param int $profileId
     * @return \Illuminate\Http\Response
     */
    public function show($profileId)
    {
        $profile = SuggestedProfile::find($profileId);

        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Approves the profile.
     *
     * @param int $profileId
     * @return \Illuminate\Http\Response
     */
    public function approveProfile($profileId)
    {
        $profile = SuggestedProfile::find($profileId);

        if ($profile) {
            $profile->update(['approval' => true]);
        }

        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Rejects the profile.
     *
     * @param int $profileId
     * @return \Illuminate\Http\Response
     */
    public function rejectProfile($profileId)
    {
        $profile = SuggestedProfile::find($profileId);
    
        if ($profile) {
            $profile->delete();
        }
    
        return response()->json(['message' => 'Profile deleted successfully'], 200);
    }
    

    public function create()
    {
    }

    /**
     * Stores the instance to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        SuggestedProfile::create([
            'username' => $request->username,
            'user_id'=> $request->user_id
        ]);

        $profile = SuggestedProfile::orderBy('id', 'DESC')->first();

        return response()->json($profile, 200, [], JSON_PRETTY_PRINT);
    }

}
