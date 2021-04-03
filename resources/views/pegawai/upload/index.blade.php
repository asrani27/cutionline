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
                      <h5 class="widget-user-desc">Dibawah ini adalah Daftar File Yang Di Upload</h5>
                    </div>
                    
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap table-sm">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>File Upload</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $no =1;
                        @endphp
                        <tbody>
                        @foreach ($data as $key => $item)
                                <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nama}}</td>
                                <td>
                                    <table class="table table-sm table-bordered" style="font-size:10px; font-family:Arial, Helvetica, sans-serif" class="text-center bg-gradient-primary">
                                    <tr>
                                        <td>File</td>
                                        <td></td>
                                        <td>Tgl Upload</td>
                                    </tr>
                                    @foreach ($item->file as $item2)
                                    <tr>
                                        <td>{{$item2->file}}</td>
                                        <td>
                                            <a href="/pegawai/upload/delete/{{$item2->id}}" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                                            {{-- <a href="/pegawai/view/{{Auth::user()->username}}/{{$item2->file}}" class="btn btn-xs btn-success" target="_blank"><i class="fas fa-eye"></i> Lihat</a> --}}
                                            <a href="/storage/{{Auth::user()->username}}/{{$item2->file}}" class="btn btn-xs btn-info" target="_blank"><i class="fas fa-download"></i> Download</a>
                                        </td>
                                        <td>{{$item2->created_at}}</td>
                                    </tr>
                                    @endforeach
                                    </table>
                                </td>
                                <td>
                                <a href="/pegawai/upload/add/{{$item->id}}" class="btn btn-xs btn-info"><i class="fas fa-upload"></i> Upload</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
@endsection

@push('js')
    
@endpush