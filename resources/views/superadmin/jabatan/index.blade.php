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
        <h4>JABATAN DI RSUD SULTAN SURIANSYAH</h4>
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DATA JABATAN RSUD SULTAN SURIANSYAH</h3>
  
                  <div class="card-tools">
                    <form method="get" action="/superadmin/manajemen/jabatan/search">
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
                        <th>Ruangan</th>
                        <th>Nama Jabatan</th>
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
                            <td>{{$item->nama}}<br />
                                Ka. Ruangan  : {{$item->karuangan == null ? '-': $item->karuangan->nama}}
                              </td>
                            <td>
                                <ul>
                                    @foreach ($item->jabatan as $item2)
                                        <li>{{$item2->nama}}
                                        
                                          <a href="/superadmin/manajemen/jabatan/edit/{{$item->id}}/{{$item2->id}}" class="btn btn-xs" data-toggle="tooltip" title='Edit Jabatan'><i class="fas fa-edit"></i></a>
                                          <a href="/superadmin/manajemen/jabatan/delete/{{$item2->id}}" class="btn btn-xs" data-toggle="tooltip" title='Hapus Jabatan' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
                                          <a href="/superadmin/manajemen/jabatan/atasan/{{$item2->id}}" class="btn btn-xs" data-toggle="tooltip" title='Atasan Langsung'><i class="fas fa-user"></i></a> <br />
                                          {{$item2->atasan == null ? '': 'Atasan Langsung : '.$item2->atasan->nama}}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                            <a href="/superadmin/manajemen/jabatan/{{$item->id}}/add" class="btn btn-xs btn-info" data-toggle="tooltip" title='Tambah Jabatan'><i class="fas fa-plus"></i> Jabatan</a>
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