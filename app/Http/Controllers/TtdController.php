<?php

namespace App\Http\Controllers;

use App\Models\Ttd;
use App\Models\Role;
use App\Models\User;
use App\Models\Kadinkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TtdController extends Controller
{
    public function index()
    {
        $data = Ttd::paginate(10);
        $kadinkes = Kadinkes::get();
        return view('superadmin.ttd.index',compact('data','kadinkes'));
    }

    public function upload($id)
    {
        $data = Ttd::find($id);
        return view('superadmin.ttd.upload',compact('data'));
    }
    
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'mimes:jpeg,png,jpg,gif'
        ]);
        
        if ($validator->fails())
        {
            toastr()->error('file harus berupa gambar');
            return back();
        }
        
        $filename = \Carbon\Carbon::now()->format('Y-m-dH-i-s') . '.' . $req->file->getClientOriginalExtension();
        //dd($filename);
        $req->file->storeAs('public/ttd', $filename);
        
        Ttd::find($id)->update([
            'file' => $filename,
        ]);

        toastr()->info('Berhasil Di Update');
        return redirect('/superadmin/ttd');
    }

    public function editKadinkes($id)
    {
        $data = Kadinkes::find($id);
        return view('superadmin.ttd.kadinkes',compact('data'));
    }
    
    public function updateKadinkes(Request $req, $id)
    {
        Kadinkes::find($id)->update($req->all());
        toastr()->info('Berhasil Di Update');
        return redirect('/superadmin/ttd');
    }

    public function createuser($id)
    {
        $role = Role::where('name', 'kadis')->first();
        $user['name'] = 'Kadinkes';
        $user['username'] = 'kadinkes';
        $user['password'] = bcrypt('cutirs');

        $u = User::create($user);
        Kadinkes::find($id)->update([
            'user_id' => $u->id,
        ]);
        $u->roles()->attach($role);
        toastr()->info('username : kadinkes, password : cutirs');
        return back();
    }

    public function resetpass($id)
    {
        Kadinkes::find($id)->user->update([
            'password' => bcrypt('cutirs'),
        ]);
        toastr()->info('username : kadinkes, password : cutirs');
        return back();
    }
}
