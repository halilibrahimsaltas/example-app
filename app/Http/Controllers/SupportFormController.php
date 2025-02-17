<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportFormController extends Controller
{
    public function supportForm()
    {
        return view('front.contact');
    }
    public function store(Request $request)
    {
        dd($request->all());
    }
}