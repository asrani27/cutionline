<?php

namespace App\Http\Controllers;

use File;
use ZipArchive;
use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\KategoriUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{

    public function user()
    {
        return Auth::user();
    }
    public function home()
    {
        $tahun = Carbon::now()->format('Y');
        $cuti = Cuti::with('pegawai')->where('pegawai_id', $this->user()->pegawai->id)->orderBy('id', 'DESC')->paginate(10);

        $daftarCuti = Cuti::where('proses_atasan', $this->user()->pegawai->id)->paginate(10);

        $sisaCuti = 12 - Cuti::where('pegawai_id', $this->user()->pegawai->id)->where('jenis_cuti_id', 1)->whereYear('mulai', '=', $tahun)->sum('lama');

        //Check Jabatan
        // if($this->user()->pegawai->jabatan != null){
        //     if($this->user()->pegawai->jabatan->view == 1){
        //         $daftarCuti = Cuti::orderBy('id', 'DESC')->paginate(10);
        //     }else{
        //         if($this->user()->pegawai->jabatan->jenis == 'manajemen'){
        //             $bawahan_id = $this->user()->pegawai->jabatan->bawahan->pluck('id');
        //             $daftarCuti = Cuti::whereIn('jabatan_id', $bawahan_id)->paginate(10);
        //         }else{
        //             if($this->user()->pegawai->karu != null){
        //                 $jabatan_id = $this->user()->pegawai->karu->jabatan->pluck('id');
        //                 $daftarCuti = Cuti::whereIn('jabatan_id', $jabatan_id)
        //                                     ->where('pegawai_id', '!=',$this->user()->pegawai->id)
        //                                     ->orderBy('id','DESC')
        //                                     ->paginate(10);

        //             }elseif($this->user()->pegawai->kai != null){
        //                 $daftarCuti = [];
        //             }else{
        //                 $daftarCuti = [];
        //             }
        //         }
        //     }
        // }else{
        //     //Jika tidak memiliki jabatan, check jika menjadi Ka. Instalasi
        //     $kai = $this->user()->pegawai->kai;
        //     $daftarCuti = [];
        // }


        //Check Jabatan
        if ($this->user()->pegawai->jabatan != null) {
            $checkAtasan = $this->user()->pegawai->jabatan->atasan;
            if ($checkAtasan == null && $this->user()->pegawai->jabatan->jenis != 'manajemen') {
                if ($this->user()->pegawai->karu != null) {
                    $atasan = $this->user()->pegawai->jabatan->ruangan->instalasi->kainstalasi;
                    $manajemen = false;
                } elseif ($this->user()->pegawai->kai != null) {
                    $atasan = $this->user()->pegawai->jabatan->ruangan->instalasi->atasanlangsung;
                    $manajemen = false;
                } else {
                    $atasan = $this->user()->pegawai->jabatan->ruangan->karuangan;
                    $manajemen = false;
                }
            } else {
                $atasan = $checkAtasan;
                $manajemen = true;
            }
        } else {
            if ($this->user()->pegawai->kai != null) {
                $atasan = $this->user()->pegawai->kai->atasanlangsung;
                $manajemen = false;
                $proses_status = 'kai';
            }

            if ($this->user()->pegawai->karu != null) {
                $atasan = $this->user()->pegawai->karu->instalasi->kainstalasi;
                $manajemen = false;
                $proses_status = 'karu';
            }
        }

        return view('pegawai.home', compact('cuti', 'daftarCuti', 'atasan', 'manajemen', 'sisaCuti'));
    }
    public function profil()
    {
        $data = Auth::user()->pegawai;
        return view('pegawai.profil', compact('data'));
    }

    public function changePegawai(Request $req)
    {
        if ($req->password != $req->password2) {
            toastr()->error('Password Tidak Sama');
        } else {
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
        return view('pegawai.edit_profil', compact('data'));
    }

    public function updateProfil(Request $req)
    {
        Auth::user()->pegawai->update($req->all());
        toastr()->info('Profil Berhasil Di Update');
        return redirect('/pegawai/profil');
    }

    public function riwayatCuti()
    {
        $cuti = Cuti::with('pegawai')->where('pegawai_id', Auth::user()->pegawai->id)->orderBy('id', 'DESC')->paginate(10);
        return view('pegawai.riwayat_cuti', compact('cuti'));
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
