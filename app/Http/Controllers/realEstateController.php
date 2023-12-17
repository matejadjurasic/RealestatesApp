<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');
define('ACCESS_TOKEN', 'EAAQSaZAhOZCsYBO38CPLyJoEAJlEE5ZADZC8QPahn9TJRL48KZCrS2jvdZAFNe1RwGt8HukemIJD2dm9mPQiUfgTnpn7DlF2rG0eqbR3RQXOZBLuYvCepvpglRzByGI2ZBB5K60Q7MgQG3SdYzczueW4vZBMWXKSZB4K0XruRpiv0FC34uGG327fQ9J45ZBZAE2dJtw7');
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
        $estates = RealEstate::latest()->paginate(5);

        return view('realestates.index',compact('estates'))->with(request()->input('page'));
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
        $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'location'=> 'required'
        ]);

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
            return redirect()->route('realestates.create')->with('failure','Invalid Parametars');
        }
        //return view('instagram-profile',['responseArray'=>$responseArray]);
        return redirect()->route('realestates.index')->with('success','RealEstate created successfully');
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
        return view('realestates.show',compact('estate'));
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
    public function update(Request $request, $id)
    {
        $estate = RealEstate::find($id);
        $request->validate([
            'price'=> 'required',
            'location'=> 'required'
        ]);

        $estate->update($request->all());

        return redirect()->route('realestates.index')->with('success','RealEstate updated successfully');
    }

    public function updateapi(Request $request,$id)
    {
        $estate = RealEstate::find($id);

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

            $estate->update(['profile_picture_url' => $responseArray['business_discovery']['profile_picture_url']],
            ['description' => $responseArray['business_discovery']['biography']],
            ['follows_count' => $responseArray['business_discovery']['follows_count']],
            ['followers_count' => $responseArray['business_discovery']['followers_count']]);

        } catch(\Exception $e){
            return redirect()->route('realestates.index')->with('failure',$e->getMessage());
        }
        //return view('instagram-profile',['responseArray'=>$responseArray]);
        return redirect()->route('realestates.index')->with('success','RealEstate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('delete from real_estates where id = ?',[$id]);

        return redirect()->route('realestates.index');
    }
}
