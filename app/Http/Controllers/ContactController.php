<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function showForm()
    {
        return view('front.contact');
    }

    public function contact(Request $request)
    {
        dd($request->all());
    }

    public function user($id)
    {
        return view('front.user', ['id' => $id]);
    }
}