<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;

use Auth;
use DB;
use Http;

class DashboardController extends Controller
{
    public function index()
    {
        //(new WeatherController)->getCurrentWeather();
        return view('dashboard', ['title' => 'dashboard Page']);
    }
    
 
    public static function getUserName()
    {
       
        $id = Auth::id();
        if($id == "") {return "";}
        $results = DB::select(DB::raw('select * from users where id = ' . $id ));
        //echo(implode(" ",$results));
        return $results[0]->name;
    }
}