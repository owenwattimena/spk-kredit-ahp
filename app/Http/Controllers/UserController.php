<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(\Auth::user()->id);
        $user->nama = $request->nama;
        $user->username = $request->username;

        if($user->save()){
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Profil Berhasil diubah!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Profil gagal diubah!"
        ];
        return redirect()->back()->with($alert);

    }
    
    public function password(Request $request)
    {
        $request->validate([
            "password" => "required",
            "password_baru" => "required|confirmed",
        ]);
        $user = User::findOrFail(\Auth::user()->id);
        if (Hash::check($request->password, $user->password)) {
            # code...
            $user->password = Hash::make($request->password_baru);
            
            if($user->save()){
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Password diubah!"
                ];
                return redirect()->route('logout')->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Password gagal diubah!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Password salah!"
        ];
        return redirect()->back()->with($alert);

    }
}