@extends('layouts.app')

@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/pegawai/surat-sakit/add" class="btn btn-sm btn-primary"><i class="fas fa-envelope"></i> Tambah Surat</a><br/><br/>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">SURAT SAKIT  {{strtoupper(Auth::user()->name)}}</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>File</th>
                  <th>aksi</th>
                </tr>
              </thead>
              @php
                  $no =1;
              @endphp
              <tbody>
                @foreach ($data as $item)
                    
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>
                    <a href="/storage/surat/{{$item->file}}" target="_blank"><i class="fas fa-envelope"></i></a>
                    </td>
                  
                  <td>
                      <a href="/pegawai/surat-sakit/delete/{{$item->id}}" class="btn btn-xs btn-danger">Hapus</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{--   --}}
          </div>
          <!-- /.card-body -->
        </div>
        {{$data->links()}}
        
        
    </div>
</div>
@endsection

@push('js')
    
@endpush