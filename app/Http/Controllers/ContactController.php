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
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        // Burada form verilerini işleyebilirsiniz (örn: veritabanına kaydetme, mail gönderme vb.)
        
        return response()->json([
            'success' => true,
            'message' => 'Form başarıyla gönderildi',
            'data' => $validatedData
        ]);
    }

    public function user($id)
    {
        return view('front.user', ['id' => $id]);
    }
}