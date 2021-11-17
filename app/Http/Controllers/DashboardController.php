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
        $error = '';
        if (Auth::check())
        {
            $tempData = $this->getSavedLocationsDB();
        }
        else{
            $tempData = $this->guest();
        }
        //dd($tempData);
        if (!$this->checkForErrors($tempData))
        {  
            //dd($tempData[0]);
            $error = $tempData['error'];
            $tempData = [];
        }
        unset($tempData['ErrFlag']); 
        $Weather = [];
        array_push($Weather,$tempData);
        array_push($Weather,$error);
        
        //dd($Weather);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $Weather]);
    }

    public function getSavedLocationsDB()
    {
        $lat = [];
        $long = [];
        $name=[];
        $response = DB::select("select * from user_locations where user_id ='".Auth::id()."'");
        foreach($response as $location)
        {
            //dd($location->NAME);
            array_push($lat, $location->LAT );            
            array_push($long, $location->LONG );
            array_push($name, $location->NAME);
            
        }
        Session::put('lat', $lat);
        Session::put('long', $long);
        Session::put('name', $name);

       // dd($lat);

        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);
        
        


        //dd($tempData);
        return $tempData;
    }



    public function guest()
    {
        $error = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ipList = explode(",", $ip);
        //$currentUserInfo = Location::get('68.188.228.138');
        $currentUserInfo = Location::get($ipList[0]);

        $name = 'Lexington, Kentucky';
        if($currentUserInfo != false) 
        {
            $name = $currentUserInfo->cityName . ", " . $currentUserInfo->regionName;
        }
        $response = (new WeatherController)->getWeatherFirst( $name);
       
        if (!$this->checkForErrors($response))
        {  
           return $response;
        }
        //dd($response);
        $lat = [$response['lat']];
        $long = [$response['lon']];
        $myName = [$name];

        Session::put('lat', $lat);
        Session::put('long', $long);
        Session::put('name', $myName);

        $response['name'] = $name;
        $tempData = [$response];
        $tempData['ErrFlag'] = false;


        return $tempData;
    }    

    
    public function AddLocation(Request $req)
    {
        $error = "";
        $lat = Session::get('lat');  
        $long = Session::get('long');
        $name = Session::get('name');

        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);
        if (!$this->checkForErrors($tempData))
        {
            
            $error = $tempData['error'];
            $tempData = [];

            $Weather = [];
            array_push($Weather,$tempData);
            array_push($Weather,$error);
            //dd($Weather);
            return view('dashboard', 
            ['title' => 'Dashboard'],
            ['weatherLocations' => $Weather]);
        }
        unset($tempData['ErrFlag']); 


        $location = $req->input()['location'];
        $newData = (new WeatherController)->getWeather($location);
        
        if ($this->checkForErrors($newData))
        {            
            if ($this->checkForDuplicates($tempData,$newData))
            {
                unset($newData['ErrFlag']); 
                array_push($tempData,$newData);
                $newLat = $newData['lat'];
                $newLong = $newData['lon'];
                $newName = $newData['name'];
                array_push($lat, $newLat );            
                array_push($long, $newLong );
                array_push($name, $newName );
                Session::put('lat', $lat);        
                Session::put('long', $long);
                Session::put('name', $name);  
                //dd($tempData);
            }  
            else{
                $error = "Let's try not to duplicate weather locations... okay?";
            }          
        }
        else{            
            $error = $newData['error'];            
        }
        $Weather = [];
        array_push($Weather,$tempData);
        array_push($Weather,$error);
        //dd($Weather);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $Weather]);


    }

    public function removeLocation(Request $req)
    {
        $error = "";
        $index = $req->input()['remove'];
        $lat = Session::get('lat');  
        $long = Session::get('long');
        $name = Session::get('name');

        if (Auth::check())
        {
            DB::select("delete from user_locations where name = '".$name[$index]."' AND user_id ='".Auth::id()."'");            
        }

        array_splice($lat, $index,1);
        array_splice($long, $index,1);
        array_splice($name, $index,1);
        Session::put('lat', $lat);        
        Session::put('long', $long);
        Session::put('name', $name);
        
        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);

        if (!$this->checkForErrors($tempData))
        {  
            $error = $tempData['error'];
            $tempData = [];
        }
        unset($tempData['ErrFlag']);   
        $Weather = [];
        array_push($Weather,$tempData);
        array_push($Weather,$error);


        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $Weather]);
    }

    public function saveLocation(Request $req)
    {
        $error = '';
        $index = $req->input()['save'];
        $lat = Session::get('lat');  
        $long = Session::get('long');
        $name = Session::get('name');
        
        if (Auth::check())
        {            
            if($this->checkForDBduplicates("name",$name[$index]))
            {
                DB::select("INSERT INTO USER_LOCATIONS ('NAME', 'LAT', 'LONG', 'USER_ID') VALUES(?, ?, ?, ?)",[$name[$index], $lat[$index], $long[$index], Auth::id()] );
            }
        }
        $tempData = (new WeatherController)->resetLocations($lat,$long,$name);

        if (!$this->checkForErrors($tempData))
        {  
            $error = $tempData['error'];
            $tempData = [];
        }
        unset($tempData['ErrFlag']); 
        $Weather = [];
        array_push($Weather,$tempData);
        array_push($Weather,$error);
        //dd($Weather);
        return view('dashboard', 
        ['title' => 'Dashboard'],
        ['weatherLocations' => $Weather]);
    }


    public function checkForDuplicates($old, $new)
    {
        foreach($old as $loc)
        {
            if (strcmp($loc['name'],$new['name']) == 0) return false;
        }
        return true;
    }

    public function checkForDBduplicates($key, $value)
    {
        $response = DB::select("select * from user_locations where ".$key." = '".$value."' AND user_id ='".Auth::id()."'");
        if (Count($response)>0) return false;
        else return true;
    }

    public function checkForErrors($new)
    {
        //dd($new);
        if (!$new['ErrFlag']) return true;
        else return false;
    }
}