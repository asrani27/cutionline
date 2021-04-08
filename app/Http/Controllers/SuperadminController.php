<?php

namespace App\Http\Controllers;

use File;
use Exception;
use ZipArchive;
use App\Models\Cuti;
use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Imports\PegawaiImport;
use App\Models\KategoriUpload;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Madnest\Madzipper\Facades\Madzipper;

class SuperadminController extends Controller
{
    public function home()
    {
        $cuti = Cuti::with('pegawai')->orderBy('id','DESC')->paginate(10);
        $pegawai = Pegawai::get();
        return view('superadmin.home',compact('cuti','pegawai'));
    }

    public function import()
    {
        return view('superadmin.pegawai.import');
    }

    public function searchPegawai()
    {
        $search = request()->get('search');
        $data = Pegawai::where('nip','LIKE', '%'.$search.'%')->orWhere('nama','LIKE', '%'.$search.'%')->paginate(10);
        
        request()->flash();
        return view('superadmin.pegawai.index',compact('data'));
    }

    public function storeImport(Request $req)
    {
        $messages = [
            'mimes' => 'File harus Excel',
            'max' => 'Maximal 15 MB'
        ];

        $rules = [
            'file' =>  'mimes:xls,xlsx|required|max:20000',
        ];
        
        $req->validate($rules, $messages);
        
        $req->flash();

        $collect = (new PegawaiImport)->toCollection($req->file('file'))->first();
        $map = $collect->map(function($item){
            if(strlen($item[3]) == 18 ){
                $attr['nama'] = $item[1];
                $attr['nip'] = $item[3];

                $cek = Pegawai::where('nip', $attr['nip'])->first();
                if($cek == null){
                    Pegawai::create($attr);
                }else{

                }
            }else{
                
            }
            return $item;
        });
        toastr()->success('Selesai Di Import');
        return redirect('/superadmin/pegawai');
    }

    public function createuser($id)
    {
        $data = Pegawai::find($id);
        $role = Role::where('name','pegawai')->first();

        $attr['name'] = $data->nama; 
        $attr['username'] = $data->nip;
        $attr['password'] = bcrypt('cutirs');
        
        $cek = User::where('username', $data->nip)->first();
        if($cek == null){
            $n = User::create($attr);
            $data->update([
                'user_id' => $n->id,
            ]);
            $n->roles()->attach($role);
            toastr()->info('Username '.$data->nip.'<br />Password : cutirs');
        }else{
            toastr()->error('Username Sudah Ada');
        }
        return back();
    }

    
    public function createalluser()
    {
        try{
            $data = Pegawai::where('user_id', null)->take(500)->get();
            
            $role = Role::where('name','pegawai')->first();
            foreach($data as $key => $item)
            {
                $attr['name'] = $item->nama; 
                $attr['username'] = $item->nip;
                $attr['password'] = bcrypt('cutirs');
    
                $cek = User::where('username', $item->nip)->first();
                if($cek == null){
                    $n = User::create($attr);
                    $item->update([
                        'user_id' => $n->id,
                    ]);
                    $n->roles()->attach($role);
                }else{
                } 
            }
            $count = Pegawai::where('user_id', null)->get()->count();
            toastr()->info('User Berhasil Di create <br /> Username NIP <br> Password cutirs');
            return back();
        }catch(\Exception $e){
            
            $data = Pegawai::where('user_id', '!=', null)->get();
            toastr()->error('Execution Time,Server Ga Kuat, <br /> User berhasil di create'.$data->count());
            return back();
        }
    }

    public function resetpass($id)
    {
        Pegawai::find($id)->user->update([
            'password' => bcrypt('cutirs')
        ]);
        toastr()->info('Password : cutirs');
        return back();
    }
    
    public function profil()
    {
        return view('superadmin.profil');
    }
    public function changeSuperadmin(Request $req)
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

    public function skpd()
    {
        $data = Skpd::get();
        return view('superadmin.skpd.index',compact('data'));
    }

    public function addSkpd()
    {
        return view('superadmin.skpd.create');
    }
    
    public function storeSkpd(Request $req)
    {
        Skpd::create($req->all());
        toastr()->success('SKPD Berhasil Di simpan');
        return redirect('/superadmin/skpd');
    }
    
    public function editSkpd($id)
    {
        $data = Skpd::find($id);
        return view('superadmin.skpd.edit',compact('data'));
    }
    
    public function updateSkpd(Request $req, $id)
    {
        Skpd::find($id)->update($req->all());
        toastr()->success('SKPD Berhasil Di Update');
        return redirect('/superadmin/skpd');
    }

    public function deleteSkpd($id)
    {
        try{
            Skpd::find($id)->delete();
            toastr()->success('SKPD Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('SKPD Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }

    public function pegawai()
    {
        $data = Pegawai::paginate(10);
        return view('superadmin.pegawai.index',compact('data'));
    }

    public function addPegawai()
    {
        $jabatan = Jabatan::with('ruangan')->get();
        return view('superadmin.pegawai.create',compact('jabatan'));
    }

    public function storePegawai(Request $req)
    {
        $messages = [
            'numeric' => 'Inputan Harus Angka',
            'min'     => 'Harus 18 Digit',
            'unique'  => 'NIP sudah Ada',
        ];

        $rules = [
            'nip' =>  'unique:pegawai|min:18|numeric',
            'nama' => 'required'
        ];
        $req->validate($rules, $messages);
        
        $req->flash();

        Pegawai::create($req->all());
        toastr()->success('Pegawai Berhasil Di simpan');
        return redirect('/superadmin/pegawai');
    }
    
    public function editPegawai($id)
    {
        $data = Pegawai::find($id);
        $dataJab = Jabatan::where('id', '!=', $data->jabatan_id)->get();
        return view('superadmin.pegawai.edit',compact('data','dataJab'));
    }
    
    public function updatePegawai(Request $req, $id)
    {
        $messages = [
            'numeric' => 'Inputan Harus Angka',
            'min'     => 'Harus 18 Digit',
            'unique'  => 'NIP sudah Ada',
        ];

        $rules = [
            'nip' =>  '|min:18|numeric|unique:pegawai,nip,'.$id,
            'nama' => 'required'
        ];
        $req->validate($rules, $messages);
        
        $req->flash();
        
        Pegawai::find($id)->update($req->all());
        toastr()->info('Pegawai Berhasil Di Update');
        return redirect('/superadmin/pegawai');
    }

    public function deletePegawai($id)
    {
        try{
            Pegawai::find($id)->user->delete();
            Pegawai::find($id)->delete();
            toastr()->success('pegawai Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('pegawai Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }
    
    public function kategori()
    {
        $data = KategoriUpload::paginate(10);
        return view('superadmin.kategori.index',compact('data'));
    }

    public function addKategori()
    {
        return view('superadmin.kategori.create');
    }
    
    public function storeKategori(Request $req)
    {
        KategoriUpload::create($req->all());
        toastr()->success('Kategori Berhasil Di simpan');
        return redirect('/superadmin/setting/kategori/upload');
    }
    
    public function editKategori($id)
    {
        $data = KategoriUpload::find($id);
        return view('superadmin.kategori.edit',compact('data'));
    }
    
    public function updateKategori(Request $req, $id)
    {
        KategoriUpload::find($id)->update($req->all());
        toastr()->success('Kategori Berhasil Di Update');
        return redirect('/superadmin/setting/kategori/upload');
    }

    public function deleteKategori($id)
    {
        try{
            KategoriUpload::find($id)->delete();
            toastr()->success('Kategori Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('Kategori Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }
    
    public function download()
    {
        $data = Pegawai::pluck('nip');
        foreach($data as $key => $item){
            $files = glob('storage/'.$item);
            Madzipper::make('storage/download/'.$item.'.zip')->add($files)->close();
        }
        
        $files = glob('storage/download/*');
        Madzipper::make('storage/download.zip')->add($files)->close();

        $name = 'DokumenPNS'.date('-d-m-Y-h-i-s');
        return Storage::download('/public/download.zip', $name);
    }
}
