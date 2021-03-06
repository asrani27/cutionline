<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Jabatan;
use App\Models\Kadinkes;
use Carbon\CarbonPeriod;
use App\Models\Jenis_cuti;
use Illuminate\Http\Request;
use App\Models\LiburNasional;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CutiController extends Controller
{
    public function user()
    {
        return Auth::user();
    }
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
        $sisaCuti = 12 - Cuti::where('pegawai_id', $this->user()->pegawai->id)->where('jenis_cuti_id', 1)->sum('lama');
        
        $mulai   = Carbon::parse($req->mulai);
        $sampai  = Carbon::parse($req->sampai);
        $pegawai = Auth::user()->pegawai;
        
        $attr = $req->all();
        $dateAll = CarbonPeriod::create($mulai, $sampai);

        $dates = [];

        foreach($dateAll as $item) {
            $dates[] = $item->format('Y-m-d');
        }

        $liburNasional = LiburNasional::get();
        $diff = collect($dates)->diff($liburNasional->pluck('tanggal'));

        $collection = collect($diff)->map(function($value, $key){
            $value = Carbon::parse($value)->format('l');
            return $value;
        });
        
        if($req->jenis_cuti_id == 1){
            // Cuti Tahunan Tidak Termasuk Hari minggu
            $attr['lama'] = count($collection->diff(['Sunday']));
        }else{
            // Cuti Lainnya Termasuk Hari minggu
            $attr['lama'] = count($collection);
        }
        if($attr['lama'] > $sisaCuti)
        {
            toastr()->error('Tidak bisa mengajukan, Sisa Cuti Anda '. $sisaCuti. ' Hari');
            return back();
        }
        Cuti::find($id)->update($attr);
        toastr()->info('Cuti Berhasil Di Update');
        return redirect('/pegawai/home');
    }

    public function store(Request $req)
    {
        
        $sisaCuti = 12 - Cuti::where('pegawai_id', $this->user()->pegawai->id)->where('jenis_cuti_id', 1)->sum('lama');
        
        $mulai   = Carbon::parse($req->mulai);
        $sampai  = Carbon::parse($req->sampai);
        $pegawai = Auth::user()->pegawai;
        
        $attr = $req->all();
        $dateAll = CarbonPeriod::create($mulai, $sampai);

        $dates = [];

        foreach($dateAll as $item) {
            $dates[] = $item->format('Y-m-d');
        }

        $liburNasional = LiburNasional::get();
        $diff = collect($dates)->diff($liburNasional->pluck('tanggal'));

        $collection = collect($diff)->map(function($value, $key){
            $value = Carbon::parse($value)->format('l');
            return $value;
        });
        
        if($req->jenis_cuti_id == 1){
            // Cuti Tahunan Tidak Termasuk Hari minggu
            $attr['lama'] = count($collection->diff(['Sunday']));
        }else{
            // Cuti Lainnya Termasuk Hari minggu
            $attr['lama'] = count($collection);
        }
        if($attr['lama'] > $sisaCuti)
        {
            toastr()->error('Tidak bisa mengajukan, Sisa Cuti Anda '. $sisaCuti. ' Hari');
            return back();
        }
        
        if($pegawai->kai == null){
            if($pegawai->karu == null){
                if($pegawai->jabatan->jenis == 'manajemen'){
                    if($pegawai->jabatan->atasan == null){
                        //Direktur RS 
                        $attr['jabatan_id'] = $pegawai->jabatan == null ? '':$pegawai->jabatan->id;
                        $attr['instalasi']  = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->instalasi->nama;
                        $attr['ruangan']    =   ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->nama;
                        
                        $attr['proses_kadis'] = 'Y';
                        $attr['proses_status'] = 'Kepala Dinas Kesehatan';
                        
                    }else{
                        $attr['jabatan_id'] = $pegawai->jabatan == null ? '':$pegawai->jabatan->id;
                        $attr['instalasi']  = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->instalasi->nama;
                        $attr['ruangan']    =   ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->nama;
                        
                        $attr['proses_atasan'] = $pegawai->jabatan->atasan->pegawai->first()->id;
                        $attr['proses_status'] = $pegawai->jabatan->atasan->nama;
                    }
                    
                }else{
                    //Bukan Manajemen
                    $attr['jabatan_id'] = $pegawai->jabatan == null ? null:$pegawai->jabatan->id;
                    $attr['instalasi']  = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->instalasi->nama;
                    $attr['ruangan']    =   ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->jabatan->ruangan->nama;
                    if($pegawai->jabatan->ruangan->karu == null){
                        $attr['proses_atasan'] = $pegawai->jabatan->ruangan->instalasi->kai;
                        $attr['proses_status'] = 'Kepala '.$pegawai->jabatan->ruangan->instalasi->nama;
                    }else{
                        
                        $attr['proses_atasan'] = $pegawai->jabatan->ruangan->karu;
                        $attr['proses_status'] = 'Kepala '.$pegawai->jabatan->ruangan->nama;
                    }
                }      
            }else{
                // Jika Karu Tidak Kosong
                
                $attr['jabatan_id']  = $pegawai->jabatan == null ? null:$pegawai->jabatan->id;
                $attr['instalasi']   = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->karu->instalasi->nama;
                $attr['ruangan']     = ($pegawai->jabatan == null ? '':$pegawai->jabatan->jenis) == 'manajemen' ? 'manajemen' : $pegawai->karu->nama;
                
                $attr['proses_atasan'] = $pegawai->karu->instalasi->kainstalasi->id;

                $attr['proses_status'] = 'Kepala '.$pegawai->karu->instalasi->nama;
                
            }
            
        }else{
            if($pegawai->kai->atasanlangsung == null){
                toastr()->info('Harap isi Atasan Langsung');
                return back();
            }else{
                $attr['jabatan_id'] = $pegawai->jabatan == null ? null:$pegawai->jabatan->id;
                $attr['instalasi'] = $pegawai->kai->nama;
                $attr['ruangan'] = '-';
                $attr['proses_atasan'] = $pegawai->kai->atasanlangsung->pegawai->first()->id;
                $attr['proses_status'] = $pegawai->kai->atasanlangsung->nama;
            }
        }
        
        $atasan = $attr['proses_status'];
        Cuti::create($attr);
        toastr()->info('Cuti Berhasil Di Ajukan, di kirim ke '. $atasan);
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
        $json1 = $cuti->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
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
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                if($this->user()->pegawai->jabatan->jenis ='manajemen' && $this->user()->pegawai->jabatan->jabatan_id == null){
                    $id_pegawai_atasan = null;
                    $proses_kadis = 'Y';
                    $atasan = 'Kepala Dinas Kesehatan';
                }else{
                    $atasan = $this->user()->pegawai->jabatan->atasan->nama;
                    $id_pegawai_atasan = $this->user()->pegawai->jabatan->atasan->pegawai->first()->id;
                    $proses_kadis = null;
                }
            }else{
                //Jika Karu Disini
                if($this->user()->pegawai->karu->instalasi->kai == null){
                    toastr()->info('Kepala Instalasi Kosong, Harap Isi Kepala Instalasi');
                    return back();
                }else{
                    $atasan = 'Kepala '.$this->user()->pegawai->karu->instalasi->nama;
                    $id_pegawai_atasan = $this->user()->pegawai->karu->instalasi->kai;
                    $proses_kadis = null;
                }
            }
        }else{
            if($this->user()->pegawai->kai->atasanlangsung == null){
                toastr()->info('Atasan Kepala Instalasi kosong, harap isi terlebih dahulu Atasan Kepala Instalasi yaitu Kepala Seksi');
                return back();
            }else{
                $atasan = $this->user()->pegawai->kai->atasanlangsung->nama;
                $id_pegawai_atasan = $this->user()->pegawai->kai->atasanlangsung->pegawai->first()->id;
                $proses_kadis = null;
            }
        }
        
        $cuti->update([
            'proses_setuju' => $json_merge,
            'proses_status' => $atasan,
            'proses_atasan' => $id_pegawai_atasan,
            'proses_kadis' => $proses_kadis,
        ]);
        
        toastr()->info('Cuti Dilanjutkan Ke Atasan : '. $atasan);
        return back();
    }

    public function setujuiskip(Cuti $cuti)
    {
        $json1 = $cuti->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
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

        //Kabid mengetahui
        $kabid_id = $this->user()->pegawai->jabatan->atasan;
        
        // Langsung ke direktur
        $id_pegawai_atasan = Jabatan::where('jenis','manajemen')->where('jabatan_id',null)->first()->pegawai[0]->id;
        $proses_kadis      = null;
        $atasan            = Jabatan::where('jenis','manajemen')->where('jabatan_id',null)->first()->nama;
        
        $cuti->update([
            'proses_setuju' => $json_merge,
            'proses_status' => $atasan,
            'proses_atasan' => $id_pegawai_atasan,
            'proses_kadis' => $proses_kadis,
            'kabid_id' => $kabid_id->id,
        ]);
        
        toastr()->info('Cuti Dilanjutkan Ke Atasan : '. $atasan);
        return back();
        
    }
    
    public function tolak(Cuti $cuti)
    {
        $json1 = $cuti->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
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
            'proses_kadis' => null,
        ]);
        toastr()->info('Cuti Di Tolak');
        return back();
    }

    public function setujuiPost(Request $req)
    {
        $json1 = Cuti::find($req->cuti_id)->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
            'status' => 'setuju',
            'catatan' => $req->catatan,
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
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                if($this->user()->pegawai->jabatan->jenis ='manajemen' && $this->user()->pegawai->jabatan->jabatan_id == null){
                    $id_pegawai_atasan = null;
                    $proses_kadis = 'Y';
                    $atasan = 'Kepala Dinas Kesehatan';
                }else{
                    $atasan = $this->user()->pegawai->jabatan->atasan->nama;
                    $id_pegawai_atasan = $this->user()->pegawai->jabatan->atasan->pegawai->first()->id;
                    $proses_kadis = null;
                }
            }else{
                //Jika Karu Disini
                if($this->user()->pegawai->karu->instalasi->kai == null){
                    toastr()->info('Kepala Instalasi Kosong, Harap Isi Kepala Instalasi');
                    return back();
                }else{
                    $atasan = 'Kepala '.$this->user()->pegawai->karu->instalasi->nama;
                    $id_pegawai_atasan = $this->user()->pegawai->karu->instalasi->kai;
                    $proses_kadis = null;
                }
            }
        }else{
            if($this->user()->pegawai->kai->atasanlangsung == null){
                toastr()->info('Atasan Kepala Instalasi kosong, harap isi terlebih dahulu Atasan Kepala Instalasi yaitu Kepala Seksi');
                return back();
            }else{
                $atasan = $this->user()->pegawai->kai->atasanlangsung->nama;
                $id_pegawai_atasan = $this->user()->pegawai->kai->atasanlangsung->pegawai->first()->id;
                $proses_kadis = null;
            }
        }
        
        $dt = Cuti::find($req->cuti_id);
        $dt->update([
            'proses_setuju' => $json_merge,
            'proses_status' => $atasan,
            'proses_atasan' => $id_pegawai_atasan,
            'proses_kadis' => $proses_kadis,
        ]);
        
        toastr()->info('Cuti Dilanjutkan Ke Atasan : '. $atasan);
        return back();
    }

    public function setujuiskipPost(Cuti $cuti)
    {
        $json1 = $cuti->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
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

        //Kabid mengetahui
        $kabid_id = $this->user()->pegawai->jabatan->atasan;
        
        // Langsung ke direktur
        $id_pegawai_atasan = Jabatan::where('jenis','manajemen')->where('jabatan_id',null)->first()->pegawai[0]->id;
        $proses_kadis      = null;
        $atasan            = Jabatan::where('jenis','manajemen')->where('jabatan_id',null)->first()->nama;
        
        $cuti->update([
            'proses_setuju' => $json_merge,
            'proses_status' => $atasan,
            'proses_atasan' => $id_pegawai_atasan,
            'proses_kadis' => $proses_kadis,
            'kabid_id' => $kabid_id->id,
        ]);
        
        toastr()->info('Cuti Dilanjutkan Ke Atasan : '. $atasan);
        return back();
        
    }
    
    public function tolakPost(Request $req)
    {
        $json1 = Cuti::find($req->cuti_id)->proses_setuju;
        
        if($this->user()->pegawai->kai == null){
            if($this->user()->pegawai->karu == null){
                $nama =$this->user()->pegawai->jabatan->nama;
            }else{
                $nama ='Kepala '.$this->user()->pegawai->karu->nama;
            }
        }else{
            $nama = 'Kepala '.$this->user()->pegawai->kai->nama;
        }
        
        $json2 = 
        [
            'id_pegawai' => $this->user()->pegawai->id,
            'nama' => $nama,
            'status' => 'tolak',
            'catatan' => $req->catatan,
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
        $dt = Cuti::find($req->cuti_id);
        $dt->update([
            'status' => 2,
            'proses_setuju' => $json_merge,
            'proses_status' => null,
            'proses_atasan' => null,
            'proses_kadis' => null,
        ]);
        toastr()->info('Cuti Di Tolak');
        return back();
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
