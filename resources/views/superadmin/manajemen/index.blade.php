@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    SUPERADMIN
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>MANAJEMEN DI RSUD SULTAN SURIANSYAH</h4>
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                    
                    <a href="/superadmin/manajemen/struktural/add" class="btn btn-xs btn-info" data-toggle="tooltip" title='Tambah'><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="/superadmin/manajemen/struktural/peta" class="btn btn-xs btn-info" data-toggle="tooltip" title='Peta' target="_blank"><i class="fas fa-sitemap"></i> Peta Jabatan</a>
  
                  <div class="card-tools">
                    <form method="get" action="/superadmin/manajemen/struktural/search">
                    <div class="input-group input-group-sm" style="width: 300px;">
                      <input type="text" name="search" class="form-control input-sm float-right" value="{{old('search')}}" placeholder="Cari">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap table-sm table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Jabatan</th>
                        <th>Atasan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                    @foreach ($data as $key => $item)
                          <tr>
                            <td>{{$key+ $data->firstItem()}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->atasan == null ? '-': $item->atasan->nama}}</td>
                            <td>
                                
                                <a href="/superadmin/manajemen/struktural/edit/{{$item->id}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title='Edit Jabatan'><i class="fas fa-edit"></i></a>
                                <a href="/superadmin/manajemen/struktural/delete/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='Hapus Jabatan' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                  {{--   --}}
                </div>
                <!-- /.card-body -->
              </div>
              {{$data->links()}}
              <!-- /.card -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')


@endpush