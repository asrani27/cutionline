@extends('layouts.app')

@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DATA CUTI PEGAWAI</h3>

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
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @php
                  $no =1;
              @endphp
              <tbody>
                @foreach ($cuti as $item)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$item->pegawai->nip}}</td>
                  <td>{{$item->pegawai->nama}}</td>
                  <td>{{$item->jabatan->nama}}</td>
                  <td>{{$item->mulai}}</td>
                  <td>{{$item->sampai}}</td>
                  <td>{{$item->lama}} Hari</td>
                  <td>
                    @if ($item->status == NULL)
                        <span class="badge badge-info">Diproses</span>
                    @elseif ($item->status == 1)
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                  </td>
                  <td>
                    <a href="/pegawai/ajukan/download/pdf/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='PDF' target="_blank"><i class="fas fa-file-pdf"></i></a>
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
    </div>
</div>
@endsection

@push('js')
    
@endpush