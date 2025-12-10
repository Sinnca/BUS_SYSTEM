<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
        // Popular routes for suggestions
        $popular_routes = [
            ['origin' => 'Manila', 'destination' => 'Cebu'],
            ['origin' => 'Manila', 'destination' => 'Davao'],
            ['origin' => 'Cebu', 'destination' => 'Manila'],
            ['origin' => 'Davao', 'destination' => 'Manila'],
        ];

        return view('user.home', compact('popular_routes'));
    }
}
