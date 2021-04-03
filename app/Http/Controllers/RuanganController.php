<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Ruangan;
use App\Models\Instalasi;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    
    public function karu()
    {
        $data = Ruangan::get();
        $pegawai = Pegawai::get();
        return view('superadmin.ruangan.karu',compact('data','pegawai'));
    }

    public function updateKaru(Request $req)
    {
        $pegawai = $req->pegawai_id;
        foreach($req->ruangan_id as $key => $item)
        {
            Ruangan::find($item)->update([
                'karu' => $pegawai[$key],
            ]);
        }
        
        toastr()->info('Kepala Ruangan Berhasil Di Simpan');
        return redirect('/superadmin/manajemen/instalasi');
    }

    public function create(Instalasi $instalasi)
    {
        return view('superadmin.ruangan.create',compact('instalasi'));
    }
    
    public function store(Request $req, Instalasi $instalasi)
    {
        $attr = $req->all();
        $attr['instalasi_id'] = $instalasi->id;
        Ruangan::create($attr);
        toastr()->info('Berhasil Di Simpan');
        return redirect('/superadmin/manajemen/instalasi');
    }
    
    public function edit(Instalasi $instalasi, Ruangan $ruangan)
    {
        return view('superadmin.ruangan.edit',compact('instalasi','ruangan'));
    }
    
    public function update(Request $req, Instalasi $instalasi, Ruangan $ruangan)
    {
        $ruangan->update($req->all());
        toastr()->info('Berhasil Di Update');
        return redirect('/superadmin/manajemen/instalasi');
    }
    
    public function destroy(Instalasi $instalasi, Ruangan $ruangan)
    {
        try{
            $ruangan->delete();
            toastr()->info('Berhasil Di Hapus');
        }catch(\Exception $e)
        {
            toastr()->error('Gagal Di Hapus');
        }
        
        return back();
    }
}
