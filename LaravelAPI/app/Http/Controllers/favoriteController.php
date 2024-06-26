<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FavoriteProfile;
use App\Models\RealEstate;
use Illuminate\Pagination\LengthAwarePaginator;

class favoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param App\Models\User
     */
    public function index(User $user)
    {
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();
        $realEstatesData = [];

        foreach ($favorites as $favorite) {
            $realEstate = RealEstate::find($favorite->realestate_id);
            if ($realEstate) {
                $realEstatesData[] = $realEstate;
            }
        }
       
        $perPage = 4; // Number of items per page
        $currentPage = request()->input('page', 1); // Get the current page from the request
        $pagedData = array_slice($realEstatesData, ($currentPage - 1) * $perPage, $perPage);

        // Create a paginator instance
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData, count($realEstatesData), $perPage, $currentPage
        );

        // Return the response with the paginated real estate data
        return response()->json($paginator, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Return all user favorites.
     *
     * @return \Illuminate\Http\Response
     * @param App\Models\User
     */
    public function getAll(User $user)
    {
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();

        return response()->json($favorites, 200, [], JSON_PRETTY_PRINT);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        auth()->user()->favoriteProfiles()->create(['realestate_id' => $id]);
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();

        //returns all user favorites
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //trigger for deacreasing the number of favorites
        auth()->user()->decrement('favorite');
        $favorites = FavoriteProfile::where('user_id', auth()->user()->id)->get();

        //returns all favorites
        return response()->json($favorites, 200, [], JSON_PRETTY_PRINT);
    }
}
