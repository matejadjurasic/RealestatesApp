<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Jsonable;

define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');
define('ACCESS_TOKEN', 'EAAQSaZAhOZCsYBOZBUbb0FRdXAOvO9EK7u0fpJMiziphwIEl8luNCimm3YBvzkEq9UlDAXr9SyaHAx3y1ANPBmorbeQ4fg2mzFzwQsdXBT4rHGudfbtZA6jcUrSdE1kcJC6rffy5EOehhZA1ZCMdSse7jqwo5abiZBW6IfzeknrZBZBomgLN4fmQdu7t4Fp7u9wRa');
define('PAGE_ID', '163196900218213');
define('INSTAGRAM_ID', '17841460419692620');

class realEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$estates = RealEstate::all();
        $estates = RealEstate::latest()->paginate(2);
        
        //return view('realestates.index',compact('estates'))->with(request()->input('page'));
        return response()->json($estates,200,[],JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('realestates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'location'=> 'required'
        ]);
        */
        $name = $request->name;
        $price = $request->price;
        $location = $request->location;
        $endpoint = ENDPOINT_BASE . INSTAGRAM_ID;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username('.$name.'){username,profile_picture_url,biography,follows_count,followers_count}',
            'access_token' => ACCESS_TOKEN
        );
    
        //add parametars to endpoint
        $endpoint .= '?' . http_build_query($igParams);
        try{
            //setup curl
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$endpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        
            //make call and get response
            $response = curl_exec($ch);
            curl_close($ch);
            $responseArray = json_decode($response,true);

            DB::insert('insert into real_estates (username,profile_picture_url,description,location,follows_count,followers_count,price)
            values (?,?,?,?,?,?,?)',[$responseArray['business_discovery']['username'],
            $responseArray['business_discovery']['profile_picture_url'],$responseArray['business_discovery']['biography'],$location,
            $responseArray['business_discovery']['follows_count'],$responseArray['business_discovery']['followers_count'],
            $price]);
        } catch(\Exception $e){
            //return redirect()->route('realestates.create')->with('failure','Invalid Parametars');
            return response()->json($e->getMessage(), 200, [], JSON_PRETTY_PRINT);
        }
        $latest = RealEstate::orderBy('id', 'DESC')->first();
        //return view('instagram-profile',['responseArray'=>$responseArray]);
        //return redirect()->route('realestates.index')->with('success','RealEstate created successfully');
        return response()->json($latest, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     *   
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estate = RealEstate::find($id);
        //return view('realestates.show',compact('estate'));
        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estate = RealEstate::find($id);
        return view('realestates.edit',compact('estate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estate = RealEstate::find($request->id);
        /*$request->validate([
            'price'=> 'required',
            'location'=> 'required'
        ]);
        */
        //$estate->update($request->all());

        $estate->price = $request->price;
        $estate->location = $request->location;

        $estate->save();

        //return redirect()->route('realestates.index')->with('success','RealEstate updated successfully');
        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
    }

    public function updateapi(Request $request)
    {
        $estate = RealEstate::find($request->id);

        $name = $estate->username;
       
        $endpoint = ENDPOINT_BASE . INSTAGRAM_ID;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username('.$name.'){username,profile_picture_url,biography,follows_count,followers_count}',
            'access_token' => ACCESS_TOKEN
        );
    
        //add parametars to endpoint
        $endpoint .= '?' . http_build_query($igParams);
        try{
            //setup curl
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$endpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        
            //make call and get response
            $response = curl_exec($ch);
            curl_close($ch);
            $responseArray = json_decode($response,true);

            $updateDetails = [
                'profile_picture_url' => $responseArray['business_discovery']['profile_picture_url'],
                'description' => $responseArray['business_discovery']['biography'],
                'follows_count' => $responseArray['business_discovery']['follows_count'],
                'followers_count' => $responseArray['business_discovery']['followers_count']
            ];
            
            DB::table('real_estates')->where('id', $request->id)->update($updateDetails);

            /*$estate->update([
            'profile_picture_url' => $responseArray['business_discovery']['profile_picture_url'],
            'description' => $responseArray['business_discovery']['biography'],
            'follows_count' => $responseArray['business_discovery']['follows_count'],
            'followers_count' => $responseArray['business_discovery']['followers_count']
            ]);
            $estate->save();*/
        } catch(\Exception $e){
            //return redirect()->route('realestates.index')->with('failure',$e->getMessage());
            return response()->json($e->getMessage(), 200, [], JSON_PRETTY_PRINT);
            
        }
        //return view('instagram-profile',['responseArray'=>$responseArray]);
        //return redirect()->route('realestates.index')->with('success','RealEstate updated successfully');
        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
        //return response()->json($responseArray, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estate = RealEstate::find($id);

        DB::delete('delete from real_estates where id = ?',[$id]);

        //return redirect()->route('realestates.index');
        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
    }
}
