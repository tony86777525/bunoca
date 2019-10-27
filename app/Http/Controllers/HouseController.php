<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        return view('house', [
            'page' => 'index'
        ]);
    }

    public function smartCity()
    {
        return view('house', [
            'page' => 'smart_city',
            'side_title' => [
                'title' => 'Smart City',
                'href' => 'SmartCity',
            ]
        ]);
    }

    public function westPoint()
    {
        return view('house', [
            'page' => 'west_point',
            'side_title' => [
                'title' => 'West Point',
                'href' => 'WestPoint',
            ]
        ]);
    }

    public function oceanPark()
    {
        return view('house', [
            'page' => 'ocean_park',
            'side_title' => [
                'title' => 'Ocean Park',
                'href' => 'OceanPark',
            ]
        ]);
    }
}
