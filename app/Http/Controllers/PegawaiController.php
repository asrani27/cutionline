<?php

namespace App\Http\Controllers;

use ZipArchive;
use File;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\KategoriUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function home()
    {
        return view('pegawai.home');
    }
    public function profil()
    {
        return view('pegawai.profil');
    }
    
    public function changePegawai(Request $req)
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

    public function upload()
    {
        $pegawai_id = Auth::user()->pegawai->id;
        $data = KategoriUpload::get()->map(function($item)use($pegawai_id){
            $item->file = $item->upload->where('pegawai_id', $pegawai_id)->sortByDesc('created_at');
            return $item;
        });
        
        return view('pegawai.upload.index',compact('data'));
    }
    
    public function addUpload($kategori_id)
    {
        $kategori = KategoriUpload::find($kategori_id);
        return view('pegawai.upload.create',compact('kategori'));
    }
    
    public function storeUpload(Request $req, $kategori_id)
    {
        $date = date('-d-m-Y-h-i-s');
        $kategori = KategoriUpload::find($kategori_id)->nama;
        
        $messages = [
            'mimes' => 'File harus PDF',
            'max' => 'Maximal 15 MB'
        ];

        $rules = [
            'file' =>  'mimes:pdf|required|max:20000',
        ];

        $req->validate($rules, $messages);
        
        $req->flash();

        $filename = $kategori.$date.'.pdf';

        $nip = Auth::user()->pegawai->nip;
        
        $req->file->storeAs('/public/'.$nip.'/',$filename);

        $attr['file'] = $filename;
        $attr['kategori_upload_id'] = $kategori_id;
        $attr['pegawai_id'] = Auth::user()->pegawai->id;
        
        Upload::create($attr);
        
        toastr()->success('File Berhasil Di Upload');
        
        return redirect('pegawai/upload');
    }

    public function viewFile($nip, $filename)
    {
        return response()->file('storage/'.$nip.'/'.$filename);
    }
    public function deleteFile($id)
    {
        $d = Upload::find($id);
        $nip = Auth::user()->pegawai->nip;
        $path = '/public/'.$nip.'/'.$d->file;
        Storage::delete($path);
        $d->delete();
        
        toastr()->success('File Berhasil Di hapus');
        return back();
    }

}
