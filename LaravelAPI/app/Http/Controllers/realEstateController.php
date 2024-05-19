<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Jsonable;

define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');
define('ACCESS_TOKEN', 'EAAQSaZAhOZCsYBOyxZBa9VurgG1vV3ZCZAYrQC1YYdYYmJT4qFaF6ZAYpDiYcLOkdrjtZBstLobSjAkSzZAwpBUDHZAleCpX5OvV85esYq0yhHyhd03oOZB3oz0synaxZAopj25HhNZAfdyx3fYMt2zIvbC3JZAt7GvNJw4Oz3tOF5j7sRJwZAjr17zGoFJvuZCAbpc8h3b');
define('PAGE_ID', '163196900218213');
define('INSTAGRAM_ID', '17841460419692620');

class realEstateController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estates = RealEstate::latest()->paginate(4);
        
        return response()->json($estates,200,[],JSON_PRETTY_PRINT);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            
            //insert instance to database
            DB::table('real_estates')->insert([
                'username' => $responseArray['business_discovery']['username'],
                'profile_picture_url' => $responseArray['business_discovery']['profile_picture_url'],
                'description' => $responseArray['business_discovery']['biography'],
                'location' => $location,
                'follows_count' => $responseArray['business_discovery']['follows_count'],
                'followers_count' => $responseArray['business_discovery']['followers_count'],
                'price' => $price
            ]);
        } catch(\Exception $e){
            //return error message
            return response()->json($e->getMessage(), 200, [], JSON_PRETTY_PRINT);
        }
        $latest = RealEstate::orderBy('id', 'DESC')->first();
        //return latest entry to database
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estate = RealEstate::find($request->id);

        //changes the database table with request params
        $estate->price = $request->price;
        $estate->location = $request->location;

        //saves the changes
        $estate->save();

        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the api data in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateapi(Request $request)
    {
        $estate = RealEstate::find($request->id);
        $id = intval($request->id);
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
            
            DB::table('real_estates')->where('id', $id)->update($updateDetails);

        } catch(\Exception $e){
            //returns error message
            return response()->json($e->getMessage(), 200, [], JSON_PRETTY_PRINT);
        }
        //returns the updated estate
        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
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

        DB::table('real_estates')->where('id', $id)->delete();

        return response()->json($estate, 200, [], JSON_PRETTY_PRINT);
    }
}
