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
        <h4>INSTALASI RSUD SULTAN SURIANSYAH</h4>
        <div class="row">
            <div class="col-12">
              <a href="/superadmin/manajemen/instalasi/add" class="btn btn-sm btn-primary"><i class="fas fa-th"></i> Tambah Instalasi</a>
              <a href="/superadmin/manajemen/instalasi/kepala" class="btn btn-sm btn-info"><i class="fas fa-user"></i> Ka. Instalasi</a>
              <a href="/superadmin/manajemen/ruangan/kepala" class="btn btn-sm btn-info"><i class="fas fa-user"></i> Ka. Ruangan</a>
              <br/><br/>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Instalasi RSUD SULTAN SURIANSYAH</h3>
  
                  <div class="card-tools">
                    <form method="get" action="/superadmin/manajemen/instalasi/search">
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
                        <th>Nama Instalasi</th>
                        <th>Ruangan</th>
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
                            <td>{{$item->nama}} <br/>
                              Ka. Instalasi : {{$item->kainstalasi == null ? '-': $item->kainstalasi->nama}}
                            </td>
                            <td>
                                <ul>
                                    @foreach ($item->ruangan as $item2)
                                        <li>{{$item2->nama}}
                                        
                                          <a href="/superadmin/manajemen/instalasi/{{$item->id}}/ruangan/edit/{{$item2->id}}" class="btn btn-xs" data-toggle="tooltip" title='Edit Ruangan'><i class="fas fa-edit"></i></a>
                                          <a href="/superadmin/manajemen/instalasi/{{$item->id}}/ruangan/delete/{{$item2->id}}" class="btn btn-xs" data-toggle="tooltip" title='Hapus Ruangan' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a> <br />
                                          Ka. Ruangan : {{$item2->karuangan == null ? '-':$item2->karuangan->nama}}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                            <a href="/superadmin/manajemen/instalasi/{{$item->id}}/ruangan/add" class="btn btn-xs btn-info" data-toggle="tooltip" title='Tambah Ruangan'><i class="fas fa-plus"></i> Ruangan</a>
                            <a href="/superadmin/manajemen/instalasi/edit/{{$item->id}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title='Edit data'><i class="fas fa-edit"></i></a>
                            <a href="/superadmin/manajemen/instalasi/delete/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='Hapus data' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
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