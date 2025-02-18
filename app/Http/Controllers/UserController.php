<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kullanıcı bulunamadı'
            ], 404);
        }

        // Debug için ekstra bilgiler ekleyelim
        return response()->json([
            'status' => 'success',
            'data' => $user,
            'debug_info' => [
                'request_time' => now()->format('Y-m-d H:i:s'),
                'user_exists' => true
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Kullanıcıyı bul
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kullanıcı bulunamadı'
            ], 404);
        }

        // Validasyon
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ]
        ]);

        try {
            // Kullanıcıyı güncelle
            $user->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Kullanıcı başarıyla güncellendi',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Güncelleme sırasında bir hata oluştu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}