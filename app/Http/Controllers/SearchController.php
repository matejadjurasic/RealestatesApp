<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RealEstate;

class SearchController extends Controller
{
    public function index(Request $request)
{
    $data['q'] = $request->query('q');
    $data['selectedLocation'] = $request->query('location');
    $data['locations'] = RealEstate::distinct('location')->pluck('location')->toArray();
    $data['operator'] = $request->query('operator');
    $data['price_start'] = $request->query('price_start');
    $data['price_end'] = $request->query('price_end');

    $data['operators'] = [
        '=' => 'jednako',
        '<' => 'manje od',
        '>' => 'vece od',
        'izmedju' => 'izmedju',
    ];

    $query = RealEstate::where(function ($query) use ($data) {
        $query->where('username', 'like', '%' . $data['q']. '%');
        $query->orWhere('description', 'like', '%' . $data['q']. '%');
    
        if ($data['selectedLocation']) {
            $query->where('location', 'like', '%' . $data['selectedLocation'] . '%');
        }
        if ($data['operator']) {
            if ($data['operator'] == 'izmedju') {
                $query->whereRaw('price BETWEEN ? AND ?', [$data['price_start'], $data['price_end']]);
            } else {
                $query->whereRaw('price ' . $data['operator'] . ' ?', $data['price_start']);
            }
        }
    })->get();


    $data['realestates_details'] = $query;
    return view('realestates_details.index', $data);
}



}
