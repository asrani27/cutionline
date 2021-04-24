<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratSakitController extends Controller
{
    public function index()
    {
        $data = SuratSakit::paginate(10);
        return view('pegawai.surat.index',compact('data'));
    }

    public function add()
    {
        return view('pegawai.surat.create');
    }
    
    public function store(Request $req)
    {
        
        DB::beginTransaction();
        try{
            $filename = \Carbon\Carbon::now()->format('Y-m-dH-i-s') . '.' . $req->file->getClientOriginalExtension();
            
            $req->file->storeAs('public/surat', $filename);

            $attr['file'] = $filename;
            $attr['pegawai_id'] = Auth::user()->pegawai->id;

            SuratSakit::create($attr);
            
            DB::commit();
            
            toastr()->info('Berhasil Di Upload');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Kesalahan Sistem');

        }
        return redirect('/pegawai/surat-sakit');
    }

    public function delete($id)
    {   
        DB::beginTransaction();
        try{
            SuratSakit::find($id)->delete();
            DB::commit();
            toastr()->info('Berhasil Di Hapus');
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Kesalahan Sistem');
        }
        return back();
    }
}
