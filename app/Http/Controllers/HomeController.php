<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;

use Request;

use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //$request2 = Request::instance();
        //$ip = $request2->getClientIp();

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ipList = explode(",", $ip);

        //$ip = $request->ip(); // Dynamic IP address 
        //$ip = '162.159.24.227'; /* Static IP address */
        // $currentUserInfo = \Location::get($ip);
        // //dump(compact('currentUserInfo'));          
         //dump($request2);
        //  $ip = $_SERVER['REMOTE_ADDR'];
        $currentUserInfo = Location::get($ipList[0]);
         //$currentUserInfo = Location::get($ip);
         $compact=compact('currentUserInfo');
        //  dump($ip);
        //  dump($currentUserInfo);
        //  dump($compact['currentUserInfo']);
        // dump(compact('currentUserInfo'));
                //return view('user', compact('currentUserInfo'));
        $city = 'Lexington';
        if($currentUserInfo != false) 
        {
            $city = $currentUserInfo->cityName;
        }
        //$response = (new WeatherController)->getWeather( $city);
        $response = (new WeatherController)->getCurrentWeather();
        //dump($response->json());
        //dump($city);

       

        return view('home', 
        ['title' => 'Home Page'],
        ['city2' =>  $city,
        'currentWeather' => $response->json()]
        

    
        );
    }
}