<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Airways;
use App\List_cities;
use App\Flights;
use DB;

class FlightController extends Controller
{
    public function getList()
    {
        $flight = list_cities::all();
        return view('front-end.index', ['flight' => $flight]);
    }

    public function detail($flight_id, $total, $flight_class, $time_from)
    {
        $flight = DB::table('flights')->where('flight_id', '=' , $flight_id)->get();
        return View('front-end.flight-detail', ['flight' => $flight, 'flight_id' => $flight_id, 
                    'total' => $total, 'flight_class' => $flight_class, 'time_from' => $time_from]);
    }

    public function booking($flight_id, $total, $flight_class, $time_from)
    {
        $flight = DB::table('flights')->where('flight_id', '=' , $flight_id)->get();
        return View('front-end.flight-book', ['flight' => $flight, 'flight_id' => $flight_id, 
                    'total' => $total, 'flight_class' => $flight_class, 'time_from' => $time_from]);
                    
    }

    public function getSearch(Request $res)
    {
        $from = $res->from;
        $to   = $res->to;
        // cau truy van search
        //$users = DB::table('flights')->where('', '=', 3)->get();               
        $users = DB::table('flights')->where([
            ['flight_city_from', 'like', '%'.$from.'%'],
            ['flight_city_to', 'like', '%'.$to.'%'],
        ])->get();
        return view('front-end.flight-list', ['search'=> $users]);
    }
}
