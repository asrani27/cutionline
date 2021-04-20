<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Jenis_cuti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CutiController extends Controller
{
    public function ajukan()
    {
        $pegawai = Auth::user()->pegawai;
        $jeniscuti = Jenis_cuti::get();
        return view('pegawai.cuti.ajukan',compact('pegawai','jeniscuti'));
    }

    public function edit($id)
    {
        $pegawai    = Auth::user()->pegawai;
        $data       = Cuti::find($id);
        $jeniscuti  = Jenis_cuti::get();
        return view('pegawai.cuti.edit',compact('data','jeniscuti','pegawai'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        if($req->dari == null){
            $attr['dari'] = null;
            $attr['nik_p'] = null;
            $attr['nama_p'] = null;
            $attr['telp_p'] = null;
        }else{
            $attr['dari'] = $req->dari;
            $attr['nik_p'] = $req->nik_p;
            $attr['nama_p'] = $req->nama_p;
            $attr['telp_p'] = $req->telp_p;
        }
        Cuti::find($id)->update($attr);
        toastr()->info('Cuti Berhasil Di Update');
        return redirect('/pegawai/home');
    }

    public function store(Request $req)
    {
        $mulai   = Carbon::parse($req->mulai);
        $sampai  = Carbon::parse($req->sampai);
        $pegawai = Auth::user()->pegawai;
        $attr = $req->all();
        $attr['lama'] = $mulai->diffInDays($sampai)+1;
        $attr['jabatan_id'] = $pegawai->jabatan == null ? '':$pegawai->jabatan->id;
        $attr['instalasi'] = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->instalasi->nama;
        $attr['ruangan'] =   ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->nama;
        //dd($attr);
        Cuti::create($attr);
        toastr()->info('Cuti Berhasil Di Ajukan, menunggu persetujuan');
        return redirect('/pegawai/home');
    }

    public function destroy(Cuti $cuti)
    {
        try{
            $cuti->delete();
            toastr()->info('Cuti Berhasil Di Hapus');

        }catch(\Exception $e)
        {
            toastr()->error('Cuti Tidak Bisa Di Hapus');
        }
        return back();
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

    public function pdf(Cuti $cuti)
    {
        $url = env('APP_URL').'/check/verifikasi/digital/cuti/rsud/'.$cuti->id;
        
        $qrcode = base64_encode(QrCode::format('svg')->size(600)->errorCorrection('H')->generate($url));
        
        $customPaper = array(0,0,610,1160);
        
        $pdf = PDF::loadView('pegawai.pdf_cuti', compact('cuti','qrcode'))->setPaper($customPaper);
        return $pdf->download('pdf.pdf');
    }
}
