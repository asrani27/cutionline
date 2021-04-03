@extends('layouts.app')

@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                      <div class="widget-user-image">
                        <img class="img-circl elevation-2" src="/theme/logo.png" alt="User Avatar">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username">Selamat Datang, {{Auth::user()->name}}</h3>
                      <h5 class="widget-user-desc">File {{$kategori->nama}} yang Di Upload Harus ber ekstensi .PDF</h5>
                    </div>
                    
                  </div>
            </div>
        </div>
        <a href="/pegawai/upload" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="/pegawai/upload/add/{{$kategori->id}}" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">File {{$kategori->nama}} </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="file"  required> 
                            @if ($errors->has('file'))
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                        @endif
                        </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="fas fa-upload"></i>  Upload</button>
                    </div>
                    <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
@endsection

@push('js')
    
@endpush