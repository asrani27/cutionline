<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiburNasional;

class LiburNasionalController extends Controller
{
    public function index()
    {
        $data = LiburNasional::orderBy('id','DESC')->paginate(10);
        return view('superadmin.libur.index',compact('data'));
    }

    public function create()
    {
        return view('superadmin.libur.create');
    }

    public function store(Request $req)
    {
        LiburNasional::create($req->all());
        toastr()->info('Berhasil DI Simpan');
        return redirect('/superadmin/libur_nasional');
    }

    public function delete($id)
    {
        LiburNasional::find($id)->delete();
        toastr()->info('Berhasil DI Hapus');
        return back();
    }
}
