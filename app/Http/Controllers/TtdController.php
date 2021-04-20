<?php

namespace App\Http\Controllers;

use App\Models\Ttd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TtdController extends Controller
{
    public function index()
    {
        $data = Ttd::paginate(10);
        return view('superadmin.ttd.index',compact('data'));
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

        return redirect('/superadmin/ttd');
    }
}
