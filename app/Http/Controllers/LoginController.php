<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/superadmin/home');
            } elseif(Auth::user()->hasRole('pegawai')) {
                return redirect('/pegawai/home');
            }
        }else{
            toastr()->error('Username / Password Tidak Ditemukan');
            return back();
        }
    }
}
