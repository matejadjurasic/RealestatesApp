<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function add_realestate_database($name,$price){

        define('ENDPOINT_BASE', 'https://graph.facebook.com/v18.0/');

        $accessToken = 'EAAQSaZAhOZCsYBO38CPLyJoEAJlEE5ZADZC8QPahn9TJRL48KZCrS2jvdZAFNe1RwGt8HukemIJD2dm9mPQiUfgTnpn7DlF2rG0eqbR3RQXOZBLuYvCepvpglRzByGI2ZBB5K60Q7MgQG3SdYzczueW4vZBMWXKSZB4K0XruRpiv0FC34uGG327fQ9J45ZBZAE2dJtw7';

        $pageId = '163196900218213';

        $instagramAccountId = '17841460419692620';

        $endpoint = ENDPOINT_BASE . $instagramAccountId;
    
        //endpoint params
        $igParams = array(
            'fields' => 'business_discovery.username('.$name.'){username,profile_picture_url,biography,follows_count,followers_count}',
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

        DB::insert('insert into real_estates (username,profile_picture_url,description,follows_count,followers_count,price)
        values (?,?,?,?,?,?)',[$responseArray['business_discovery']['username'],
        $responseArray['business_discovery']['profile_picture_url'],$responseArray['business_discovery']['biography'],
        $responseArray['business_discovery']['follows_count'],$responseArray['business_discovery']['followers_count'],
        $price]);

        //$table->string('username');
        //$table->string('profile_picture_url');
        //$table->text('description');
        //$table->integer('follows_count');
        //$table->integer('followers_count');
        //$table->double('price');

        //return view('instagram-profile',['responseArray'=>$responseArray]);
        return $responseArray;

    }
}
