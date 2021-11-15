<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;

use Auth;
use DB;
use Http;

use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ipList = explode(",", $ip);

     
        $currentUserInfo = Location::get($ipList[0]);
  


        $city = 'Lexington';
        if($currentUserInfo != false) 
        {
            $city = $currentUserInfo->cityName;
        }
        $response = (new WeatherController)->getWeather( $city);

        $name = $request->input('location');
        //dump($name);
       

        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['city' =>  $city,
        'currentWeather' => $response->json()]);
       
    }
    
 
    public static function getUserName()
    {
       
        $id = Auth::id();
        if($id == "") {return "";}
        $results = DB::select(DB::raw('select * from users where id = ' . $id ));
        //echo(implode(" ",$results));
        return $results[0]->name;
    }

    
    public function getLocations(Request $req)
    {
        dd($req->input());
    }
}