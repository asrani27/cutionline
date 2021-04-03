<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $data = Ruangan::with('jabatan')->paginate(10);
        return view('superadmin.jabatan.index',compact('data'));
    }

    public function store(Request $req, Ruangan $ruangan)
    {
        $attr               = $req->all();
        $attr['nama']       = strtoupper($req->nama);
        $attr['ruangan_id'] = $ruangan->id;

        Jabatan::create($attr);

        toastr()->info('Jabatan berhasil di Simpan');
        return redirect('/superadmin/manajemen/jabatan');
    }

    public function create(Ruangan $ruangan)
    {
        $jabatan = Jabatan::where('ruangan_id', $ruangan->id)->get();
        return view('superadmin.jabatan.create',compact('ruangan','jabatan'));
    }

    public function edit(Ruangan $ruangan, Jabatan $jabatan)
    {
        $dataJab = Jabatan::where('ruangan_id', $ruangan->id)->where('id', '!=', $jabatan->id)->get();
        return view('superadmin.jabatan.edit',compact('ruangan','jabatan','dataJab'));
        
    }
    public function update(Request $req, Ruangan $ruangan, Jabatan $jabatan)
    {
        $attr = $req->all();
        $attr['ruangan_id'] = $ruangan->id;
        $jabatan->update($attr);
        toastr()->info('Jabatan berhasil di Update');
        return redirect('/superadmin/manajemen/jabatan');

    }
    public function destroy(Jabatan $jabatan)
    {
        try{
            $jabatan->delete();
            toastr()->info('Berhasil Di Hapus');
        }catch(\Exception $e){
            
        toastr()->error('Tidak Bisa Di Hapus');
        }
        return back();
    }
}
