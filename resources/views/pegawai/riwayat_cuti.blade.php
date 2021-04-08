@extends('layouts.app')

@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">RIWAYAT CUTI  {{strtoupper(Auth::user()->name)}}</h3>

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
                  <th>Instalasi</th>
                  <th>Ruangan</th>
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
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
                  <td>{{$item->jabatan == null ? '':$item->jabatan->nama}}</td>
                  <td>{{$item->instalasi}}</td>
                  <td>{{$item->ruangan}}</td>
                  <td>{{\Carbon\Carbon::parse($item->mulai)->format('d M Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($item->sampai)->format('d M Y')}}</td>
                  <td>{{$item->lama}} Hari kerja</td>
                  <td>
                    @if ($item->status == NULL)
                        <span class="badge badge-info">Diproses</span>
                    @elseif ($item->status == 1)
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{--   --}}
          </div>
          <!-- /.card-body -->
        </div>
        {{$cuti->links()}}
        
        
    </div>
</div>
@endsection

@push('js')
    
@endpush