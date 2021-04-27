<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    public function index()
    {
        $data = Jabatan::where('jenis','manajemen')->paginate(10);
        return view('superadmin.manajemen.index',compact('data'));
    }

    public function create()
    {
        $atasan = Jabatan::where('jenis','manajemen')->get();
        return view('superadmin.manajemen.create',compact('atasan'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['jenis'] = 'manajemen';
        Jabatan::create($attr);
        
        toastr()->info('Jabatan Berhasil Di Simpan');
        return redirect('/superadmin/manajemen/struktural');
    }

    public function edit($id)
    {
        $data = Jabatan::find($id);
        $atasan = Jabatan::where('jenis','manajemen')->get();
        return view('superadmin.manajemen.edit',compact('atasan','data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $attr['jenis'] = 'manajemen';
        Jabatan::find($id)->update($attr);
        
        toastr()->info('Jabatan Berhasil Di Update');
        return redirect('/superadmin/manajemen/struktural');
    }

    public function delete($id)
    {
        try{
            Jabatan::find($id)->delete();
            toastr()->info('Jabatan Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('Gagal Di Hapus karena memiliki bawahan, harap hapus bawahan terlebih dahulu');
            return back();
        }
    }

    public function view($id)
    {
        Jabatan::find($id)->update([
            'view' => 1,
        ]);
        
        toastr()->info('Jabatan ini bisa melihat semua cuti pegawai di RS');
        return back();
    }

    public function notview($id)
    {
        Jabatan::find($id)->update([
            'view' => NULL,
        ]);
        
        toastr()->info('Jabatan ini tidak bisa melihat semua cuti pegawai di RS');
        return back();
    }

    public function skip($id)
    {
        Jabatan::find($id)->update([
            'skip' => 1,
        ]);
        
        toastr()->info('Jabatan ini bisa melewati persetujuan kabid/setara dan langsung ke direktur');
        return back();
    }

    public function notskip($id)
    {
        Jabatan::find($id)->update([
            'skip' => NULL,
        ]);
        
        toastr()->info('Jabatan ini tidak bisa melewati persetujuan kabid/setara dan langsung ke direktur');
        return back();
    }
}
