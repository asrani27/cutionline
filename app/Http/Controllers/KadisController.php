<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
