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
        <h4>PEGAWAI RSUD SULTAN SURIANSYAH</h4>
        <div class="row">
            <div class="col-12">
              <a href="/superadmin/pegawai/add" class="btn btn-sm btn-primary"><i class="fas fa-users"></i> Tambah Pegawai</a>
              <a href="/superadmin/pegawai/import" class="btn btn-sm btn-warning"><i class="fas fa-upload"></i> Import Data PNS</a>
              <a href="/superadmin/pegawai/createuser" class="btn btn-sm bg-purple"><i class="fas fa-key"></i> Create User & Pass PNS</a>
              <a href="/superadmin/pegawai" class="btn btn-sm bg-info"><i class="fas fa-recycle"></i> Refresh</a>
              <br/><br/>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pegawai RSUD SULTAN SURIANSYAH</h3>
  
                  <div class="card-tools">
                    <form method="get" action="/superadmin/pegawai/search">
                    <div class="input-group input-group-sm" style="width: 300px;">
                      <input type="text" name="search" class="form-control input-sm float-right" value="{{old('search')}}" placeholder="Cari NIP / Nama">
  
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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
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
                            <td>{{$item->nip}}
                            </td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->jabatan == null ? '' :$item->jabatan->nama}}</td>
                            <td>
                              @if ($item->user_id == null)
                                <a href="/superadmin/pegawai/createuser/{{$item->id}}" class="btn btn-xs btn-secondary"><i class="fas fa-key"></i> Create User</a>
                              @else
                              <a href="/superadmin/pegawai/resetpass/{{$item->id}}" class="btn btn-xs btn-secondary"><i class="fas fa-key"></i> Reset Pass</a>
                                  
                              @endif
                            {{-- <a href="#" class="btn btn-xs btn-info" data-toggle="tooltip" title='lihat data'><i class="fas fa-eye"></i></a> --}}
                            <a href="/superadmin/pegawai/edit/{{$item->id}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title='Edit data'><i class="fas fa-edit"></i></a>
                            <a href="/superadmin/pegawai/delete/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='Hapus data' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
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