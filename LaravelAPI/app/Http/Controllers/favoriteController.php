<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FavoriteProfile;

class favoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();
        //->with('real_estates')
        //->get();

       /* return view('profile.index',[
            'user' => $user,
            'favorites' => $favorites

        ]);*/
        return response()->json($favorites, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        auth()->user()->favoriteProfiles()->create(['realestate_id' => $id]);

        //return redirect()->route('realestates.index')->with('success', 'Real estate added to favorites');
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();
        return response()->json($favorites, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->favoriteProfiles()->where('realestate_id', $id)->delete();

        //return back()->with('success', 'Real estate removed from favorites');
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();
        return response()->json($favorites, 200, [], JSON_PRETTY_PRINT);
    }
}
