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
                    <div class="widget-user-header bg-gradient-purple">
                      <div class="widget-user-image">
                        <img class="img-circl elevation-2" src="/theme/pemko.png" alt="User Avatar">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                      <h5 class="widget-user-desc">Selamat Datang Di Halaman Administrator</h5>
                    </div>
                    
                  </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-primary">
                <div class="inner">
                  <h3>{{$cuti->count()}}</h3>
                  
                  <p>TOTAL CUTI</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-gradient-success">
                <div class="inner">
                  <h3>{{$pegawai->count()}}</h3>
  
                  <p>Jumlah Pegawai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DATA CUTI PEGAWAI TERBARU</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NIP/NIK/Nama/Jabatan</th>
                  <th>Instalasi</th>
                  <th>Ruangan</th>
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
                  <th>Pengganti</th>
                  <th>Proses Persetujuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @php
                  $no =1;
              @endphp
              <tbody>
                @foreach ($cuti as $item)
                <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                  <td>{{$no++}}</td>
                  <td>{{$item->pegawai->nama}}<br/>
                    NIP/NIK.{{$item->pegawai->nip}}<br/>
                    {{$item->jabatan == null ? '': $item->jabatan->nama}}
                  </td>
                  <td>{{$item->instalasi}}</td>
                  <td>{{$item->ruangan}}</td>
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
                    @if ($item->dari == NULL)
                        -
                    @elseif ($item->dari == 1)
                      Dari : Dalam RS<br/>
                      NIK/NIP : {{$item->nik_p}}<br/>
                      Nama : {{$item->nama_p}}<br/>
                      Telp : {{$item->telp_p}}<br/>
                    @else
                      Dari : Luar RS<br/>
                      NIK/NIP : {{$item->nik_p}}<br/>
                      Nama : {{$item->nama_p}}<br/>
                      Telp : {{$item->telp_p}}<br/>
                    @endif
                    
                  </td>
                  <td>
                    <ul>
                    @foreach (collect(json_decode($item->proses_setuju)) as $item2)
                        <li>{{$item2->nama}} - {{$item2->status}}</li>
                    @endforeach
                    </ul>
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
          </div>
          <!-- /.card-body -->
        </div>
        {{$cuti->links()}}
    </div>
</div>
@endsection

@push('js')
    
@endpush