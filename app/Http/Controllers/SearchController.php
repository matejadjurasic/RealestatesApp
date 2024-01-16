<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RealEstate;

class SearchController extends Controller
{
    public function index(Request $request)
    {   
    $data['q'] = $request->query('q');
    $data['locations'] = RealEstate::distinct('location')->pluck('location')->toArray();
    $data['selectedLocation'] = $request->query('location_name');
    $data['operator'] = $request->query('operator');
    $data['price_start'] = $request->query('price_start');
    $data['price_end'] = $request->query('price_end');

    $data['operators'] = [
        '=' => 'jednako',
        '<' => 'manje od',
        '>' => 'vece od',
        'izmedju' => 'izmedju',
    ];

    $query = RealEstate::select();

    $query->where(function ($query) use ($data) {
        $query->where('username', 'like', '%' . $data['q']. '%')
              ->orWhere('description', 'like', '%' . $data['q']. '%');
    });

    if ($data['selectedLocation']) {
        $query->where('location', 'like', '%' . $data['selectedLocation'] . '%');
    }

    if ($data['operator']) {
        if ($data['operator'] == 'izmedju') {
            $query->whereBetween('price', [$data['price_start'], $data['price_end']]);
        } else {
            $query->where('price', $data['operator'], $data['price_start']);
        }
    }

    
    $data['realestates_details'] = $query->paginate(5);

    //return view('realestates_details.index', $data);
    return response()->json($data, 200, [], JSON_PRETTY_PRINT);
}

}
