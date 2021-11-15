<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;
use Session;
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
        //$currentUserInfo = Location::get('68.188.228.138');
        //dd($currentUserInfo);


        $name = 'Lexington, Kentucky';
        if($currentUserInfo != false) 
        {
            $name = $currentUserInfo->cityName . ", " . $currentUserInfo->regionName;
        }
        $response = (new WeatherController)->getWeatherFirst( $name);
        
 
        //dump($name);
        //$lat = [$response['lat']];
        //$long = [$response['lon']];
        $lat = [$response['lat']];
        $long = [$response['lon']];
        $myName = [$name];

        Session::put('lat', $lat);
        Session::put('long', $long);
        Session::put('name', $myName);


        $Data = json_decode($response, true);
        $Data['name'] = $name;

        $tempData = [$Data];

        //dd($tempData);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $tempData]);
       
    }
    
 
    public static function getUserName()
    {
       
        $id = Auth::id();
        if($id == "") {return "";}
        $results = DB::select(DB::raw('select * from users where id = ' . $id ));
        //echo(implode(" ",$results));
        return $results[0]->name;
    }

    
    public function AddLocation(Request $req)
    {
        $lat = Session::get('lat');  
        $long = Session::get('long');
        $name = Session::get('name');

        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);

        $location = $req->input()['location'];
        $newData = (new WeatherController)->getWeather($location);

        array_push($tempData,$newData);
        //dd($newData);
        $newlat = $newData['lat'];
        $newlong = $newData['lon'];
        $newName = $newData['name'];
        array_push($lat, $newlat );            
        array_push($long, $newlong );
        array_push($name, $newName );
        //dd($lat);
        Session::put('lat', $lat);        
        Session::put('long', $long);
        Session::put('name', $name);

        //dd($tempData);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $tempData]);


    }

    public function removeLocation(Request $req)
    {

        //dd($req);
        //dd($index = $req->input()['remove']);
        $index = $req->input()['remove'];
        $lat = Session::get('lat');  
        $long = Session::get('long');
        $name = Session::get('name');
        array_splice($lat, $index,1);
        array_splice($long, $index,1);
        array_splice($name, $index,1);
        Session::put('lat', $lat);        
        Session::put('long', $long);
        Session::put('name', $name);
        
        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);
        
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $tempData]);
    }
}