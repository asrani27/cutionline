<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Kadinkes;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KadisController extends Controller
{
    public function home()
    {
        $data = Cuti::where('proses_kadis', 'Y')->paginate(10);
        $pegawai = Pegawai::get();
        return view('kadis.home',compact('data','pegawai'));
    }
    public function profil()
    {
        return view('kadis.profil');
    }

    public function changeKadis(Request $req)
    {
        if($req->password != $req->password2){
            toastr()->error('Password Tidak Sama');
        }else{
            $p = Auth::user();
            $p->password = bcrypt($req->password);
            $p->save();
            toastr()->success('Password Berhasil Di Ubah');
        }
        return back();
    }
    public function setujui(Cuti $cuti)
    {
        $json1 = $cuti->proses_setuju;
        $json2 = 
            [
                'id_pegawai' => 0,
                'nama' => 'Kepala Dinas Kesehatan',
                'status' => 'setuju',
            ];
        
        $json_proses = json_decode($json1, true);
        if($json_proses != null){
            foreach($json_proses as $item)
            {
                $data_json[] = $item;
            }
                $data_json[] = $json2;
        
                $json_merge = json_encode($data_json);
        }else{
                $json_merge = '['.json_encode($json2).']';
        }
        
        $cuti->update([
            'proses_setuju' => $json_merge,
            'proses_status' => null,
            'proses_atasan' => null,
            'proses_kadis' => 'T',
            'status' => 1
        ]);
        
        toastr()->info('Cuti Di Setujui');
        return back();
    }

    public function tolak(Cuti $cuti)
    {
        $json1 = $cuti->proses_setuju;
        $json2 = 
            [
                'id_pegawai' => 0,
                'nama' => 'Kepala Dinas Kesehatan',
                'status' => 'tolak',
            ];
        
        $json_proses = json_decode($json1, true);
        if($json_proses != null){
            foreach($json_proses as $item)
            {
                $data_json[] = $item;
            }
                $data_json[] = $json2;
        
                $json_merge = json_encode($data_json);
        }else{
                $json_merge = '['.json_encode($json2).']';
        }
        
        $cuti->update([
            'status' => 2,
            'proses_setuju' => $json_merge,
            'proses_status' => null,
            'proses_atasan' => null,
            'proses_kadis' => 'T'
        ]);
        toastr()->info('Cuti Di Tolak');
        return back();
    }

    public function cuti()
    {
        $data = Cuti::where('proses_kadis', 'T')->get();
        return view('kadis.riwayat',compact('data'));
    }
    
    public function pdf(Cuti $cuti)
    {
        $url = env('APP_URL').'/check/verifikasi/digital/cuti/rsud/'.$cuti->id;
        
        $qrcode = base64_encode(QrCode::format('svg')->size(600)->errorCorrection('H')->generate($url));
        
        $customPaper = array(0,0,610,1160);
        
        $kadinkes = Kadinkes::first();
        $direktur = Jabatan::where('jenis','manajemen')->where('jabatan_id', null)->first();
        
        $sisaCuti = 12 - Cuti::where('pegawai_id', $cuti->pegawai_id)->where('jenis_cuti_id', 1)->sum('lama');
        
        $pdf = PDF::loadView('pegawai.pdf_cuti', compact('cuti','qrcode','kadinkes','direktur','sisaCuti'))->setPaper($customPaper);
        return $pdf->download('pdf.pdf');
    }
}
