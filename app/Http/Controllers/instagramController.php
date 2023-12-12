<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class instagramController extends Controller
{
    public function getInfo(){

        define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');

        $accessToken = 'EAAQSaZAhOZCsYBOZBjZCFupW5Ik3gRydZB0ST6PZABOKZAmKBJnuzKmxvhjvF9A2HhT8PqNTOvwRZAZBtZCmZCW38AlinLZBqPlusQ3tIJNpIiibbLsThBZBkw5wFTcp0swmar7M5djOKoivbJJUtHG2cUHgatNZCtNWWuFXfZCUzks7wqNhKENZAAf6yL0FsxKOJaPdUAVikNG9F2gdZAAk3cjZBMrTJET5jnpUSjm8DoRNQZD';

        $pageId = '163196900218213';

        $instagramAccountId = '17841460419692620';

        $endpointFormat = ENDPOINT_BASE . '{ig-user-id}?fields=business_discovery.username(ig-username){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count}&access_token={access-token}"';
        $endpoint = ENDPOINT_BASE . $instagramAccountId;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username(bluebottle){username,website,name,ig_id,id,profile_picture_url,biography,follows_count,followers_count,media_count,media}',
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
}
