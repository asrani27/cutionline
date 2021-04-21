<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KadisController extends Controller
{
    public function home()
    {
        $data = Cuti::where('proses_kadis', 'Y')->paginate(10);
        $pegawai = Pegawai::get();
        return view('kadis.home',compact('data','pegawai'));
    }
}
