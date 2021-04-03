<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Instalasi;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    public function index()
    {
        $data = Instalasi::with('ruangan')->paginate(10);
        return view('superadmin.instalasi.index',compact('data'));
    }
    
    public function kai()
    {
        $data = Instalasi::get();
        $pegawai = Pegawai::get();
        return view('superadmin.instalasi.kai',compact('data','pegawai'));
    }

    public function updateKai(Request $req)
    {
        $pegawai = $req->pegawai_id;
        foreach($req->instalasi_id as $key => $item)
        {
            Instalasi::find($item)->update([
                'kai' => $pegawai[$key],
            ]);
        }
        
        toastr()->info('Kepala Instalasi Berhasil Di Simpan');
        return redirect('/superadmin/manajemen/instalasi');
    }

    public function create()
    {
        return view('superadmin.instalasi.create');
    }
    
    public function store(Request $req)
    {
        Instalasi::create($req->all());
        toastr()->info('Instalasi Berhasil Di Simpan');
        return redirect('/superadmin/manajemen/instalasi');
    }
    
    public function edit($id)
    {
        $data = Instalasi::findOrFail($id);
        return view('superadmin.instalasi.edit',compact('data'));
    }
    
    public function update(Request $req, Instalasi $instalasi)
    {
        $instalasi->update([
            'nama' => $req->nama,
        ]);
        toastr()->info('Instalasi Berhasil Di Update');
        return redirect('/superadmin/manajemen/instalasi');
    }
    
    public function destroy(Instalasi $instalasi)
    {
        try{
            $instalasi->delete();
            toastr()->info('Instalasi berhasil di hapus');
        }catch(\Exception $e)
        {
            toastr()->error('Instalasi tidak dapat di hapus karena memiliki ruangan');
        }
        return back();
    }
}
