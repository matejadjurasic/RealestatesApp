<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');

//$accessToken = 'EAAQSaZAhOZCsYBO38CPLyJoEAJlEE5ZADZC8QPahn9TJRL48KZCrS2jvdZAFNe1RwGt8HukemIJD2dm9mPQiUfgTnpn7DlF2rG0eqbR3RQXOZBLuYvCepvpglRzByGI2ZBB5K60Q7MgQG3SdYzczueW4vZBMWXKSZB4K0XruRpiv0FC34uGG327fQ9J45ZBZAE2dJtw7';

//$pageId = '163196900218213';

//$instagramAccountId = '17841460419692620';

class instagramController extends Controller
{
    
    
    public function getInfo(){

        define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');

        $accessToken = 'EAAQSaZAhOZCsYBO38CPLyJoEAJlEE5ZADZC8QPahn9TJRL48KZCrS2jvdZAFNe1RwGt8HukemIJD2dm9mPQiUfgTnpn7DlF2rG0eqbR3RQXOZBLuYvCepvpglRzByGI2ZBB5K60Q7MgQG3SdYzczueW4vZBMWXKSZB4K0XruRpiv0FC34uGG327fQ9J45ZBZAE2dJtw7';

        $pageId = '163196900218213';

        $instagramAccountId = '17841460419692620';

        $endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username(ig-username){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count}&access_token={access-token}"';
        $endpoint = ENDPOINT_BASE . $instagramAccountId;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username(bluebottle){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{media_url,children{media_url}}}',
            'access_token' => $accessToken
        );
    
        //add parametars to endpoint
        $endpoint .= '?' . http_build_query($igParams);
    
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

        return view('instagram-business-info',['responseArray'=>$responseArray]);
    }

    public function add_realestate($name){

        define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');

        $accessToken = 'EAAQSaZAhOZCsYBO38CPLyJoEAJlEE5ZADZC8QPahn9TJRL48KZCrS2jvdZAFNe1RwGt8HukemIJD2dm9mPQiUfgTnpn7DlF2rG0eqbR3RQXOZBLuYvCepvpglRzByGI2ZBB5K60Q7MgQG3SdYzczueW4vZBMWXKSZB4K0XruRpiv0FC34uGG327fQ9J45ZBZAE2dJtw7';

        $pageId = '163196900218213';

        $instagramAccountId = '17841460419692620';

        $endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username(ig-username){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count}&access_token={access-token}"';
        $endpoint = ENDPOINT_BASE . $instagramAccountId;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username('.$name.'){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media{media_url,children{media_url}}}',
            'access_token' => $accessToken
        );
    
        //add parametars to endpoint
        $endpoint .= '?' . http_build_query($igParams);
    
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

        //return view('instagram-profile',['responseArray'=>$responseArray]);
        return $responseArray;
    }

}
