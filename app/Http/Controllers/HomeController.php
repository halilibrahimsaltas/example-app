<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {

        $age = 28;
        $name = "John";
        $surname = "Doe";
        $city = "Istanbul";
        $country = "Turkey";
        $email = "john.doe@example.com";
        
        return view('front.index', compact('age', 'name', 'surname', 'city', 'country', 'email'));
    }
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
} 