<?php

namespace App\Http\Controllers;

use File;
use ZipArchive;
use App\Models\Cuti;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\KategoriUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function home()
    {
        $cuti = Cuti::with('pegawai')->where('pegawai_id', Auth::user()->pegawai->id)->orderBy('id','DESC')->paginate(10);
        if(Auth::user()->pegawai->karu != null){
            $jabatan_id = Auth::user()->pegawai->karu->jabatan->pluck('id');
            $daftarCuti = Cuti::whereIn('jabatan_id', $jabatan_id)
                                ->where('pegawai_id', '!=',Auth::user()->pegawai->id)
                                ->orderBy('id','DESC')
                                ->paginate(10);
            
        }else{
            $daftarCuti = [];
        }
        
        return view('pegawai.home',compact('cuti','daftarCuti'));
    }
    public function profil()
    {
        $data = Auth::user()->pegawai;
        return view('pegawai.profil',compact('data'));
    }
    
    public function changePegawai(Request $req)
    {
        if($req->password != $req->password2){
            toastr()->error('Password Tidak Sama');
        }else{
            $p = Auth::user();
            $p->password = bcrypt($req->password);
            $p->save();
            toastr()->info('Password Berhasil Di Ubah');
        }
        return back();
    }

    public function editProfil()
    {
        $data = Auth::user()->pegawai;
        return view('pegawai.edit_profil',compact('data'));
    }

    public function updateProfil(Request $req)
    {
        Auth::user()->pegawai->update($req->all());
        toastr()->info('Profil Berhasil Di Update');
        return redirect('/pegawai/profil');
    }
    
    public function riwayatCuti()
    {
        $cuti = Cuti::with('pegawai')->where('pegawai_id', Auth::user()->pegawai->id)->orderBy('id','DESC')->paginate(10);
        return view('pegawai.riwayat_cuti',compact('cuti'));
    }

    public function setujui(Cuti $cuti)
    {
        $cuti->update([
            'status' => 1,
            'validator' => Auth::user()->pegawai->id,
        ]);
        toastr()->info('Cuti Di Setujui');
        return back();
    }

    
    public function tolak(Cuti $cuti)
    {
        $cuti->update([
            'status' => 2,
            'validator' => Auth::user()->pegawai->id,
        ]);
        toastr()->info('Cuti Di Tolak');
        return back();
    }
}
