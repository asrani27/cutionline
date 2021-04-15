@extends('layouts.app')

@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gradient-purple">
                      <div class="widget-user-image">
                        <img class="img-circl elevation-2" src="/theme/pemko.png" alt="User Avatar">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username">Selamat Datang, {{Auth::user()->name}}</h3>
                      <h5 class="widget-user-desc">{{Auth::user()->pegawai->jabatan == null ? '-': Auth::user()->pegawai->jabatan->nama}}
                      -

                      @if (Auth::user()->pegawai->karu != null)
                        Karu {{Auth::user()->pegawai->karu->nama}}
                      @endif                        
                      @if (Auth::user()->pegawai->kai != null)
                        Kai {{Auth::user()->pegawai->kai->nama}}
                      @endif  
                      
                      @if (Auth::user()->pegawai->jabatan == null)
                          -
                      @else
                          @if (Auth::user()->pegawai->jabatan->jenis == 'manajemen')
                          <br/>Manajemen 
                          @else
                          {{Auth::user()->pegawai->jabatan->ruangan->nama}}
                          @endif
                      @endif
                      </h5>
                    </div>
                    
                  </div>
            </div>
            
            <div class="col-lg-6 col-12">
              <div class="card card-widget widget-user-2">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-gradient-purple">
                    <div class="widget-user-image">
                      <img class="img-circl elevation-2" src="/theme/pemko.png" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    @if ($atasan->jenis == 'manajemen')
                  
                    <h3 class="widget-user-username">Atasan : {{count($atasan->pegawai) == 0 ? '-': $atasan->pegawai->first()->nama}}</h3>
                      <h5 class="widget-user-desc">{{$atasan->nama}}<br/>Manajemen</h5>
                      
                    @else
                    <h3 class="widget-user-username">Atasan : {{$atasan->nama}}</h3>
                      <h5 class="widget-user-desc">{{$atasan->jabatan == null ? '-': $atasan->jabatan->nama}}
                        -
                        @if ($atasan->karu != null)
                          Ka. Ruangan : {{$atasan->karu->nama}}<br/>
                          <h5 class="widget-user-desc">
                              {{$atasan->karu->nama}}
                          </h5>
                        @endif                        
                        @if ($atasan->kai != null)
                          Ka. Instalasi {{$atasan->kai->nama}}<br/>
                          <h5 class="widget-user-desc">
                              {{$atasan->kai->nama}}
                          </h5>
                        @endif  
                      </h5>
                    @endif
                    
                    <h5 class="widget-user-desc">
                      
                    </h5>
                    
                  </div>
                  
                </div>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
              <div class="card">
                <div class="card-body text-center">
                  <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/ajukan/cuti">
                    <i class="fas fa-edit"></i> AJUKAN CUTI
                  </a>
                  <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/profil">
                    <i class="fas fa-user"></i> PROFIL
                  </a>
                  <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/riwayat/cuti">
                    <i class="fas fa-file"></i> RIWAYAT CUTI
                  </a>
                  
                </div>
                <!-- /.card-body -->
              </div>
            </div>
        </div>
        
        @if (Auth::user()->pegawai->karu != null)
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DAFTAR KARYAWAN MENGAJUKAN CUTI</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap table-sm table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>NIP/NIK</th>
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
                  @foreach ($daftarCuti as $item)
                      
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->pegawai->nip}}</td>
                    <td>{{$item->pegawai->nama}}</td>
                    <td>{{$item->jabatan == null ? '': $item->jabatan->nama}}</td>
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
                    <td>
                      @if ($item->status == NULL)
                      <a href="/pegawai/ajukan/validasi/setujui/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Setujui' onclick="return confirm('Yakin ingin di setujui?, setelah di setujui maka tidak dapat di ubah kembali');"><i class="fas fa-check"></i></a>
                      <a href="/pegawai/ajukan/validasi/tolak/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='Tolak' onclick="return confirm('Yakin ingin di tolak?, setelah di tolak maka tidak dapat di ubah kembali');"><i class="fas fa-times"></i></a>
                      
                      @endif

                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              {{--   --}}
            </div>
            <!-- /.card-body -->
          </div> 
          {{$daftarCuti->links()}}
        @endif

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
                  <td>
                    
                    @if ($item->status == NULL)
                    <a href="/pegawai/ajukan/edit/{{$item->id}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title='Edit data'><i class="fas fa-edit"></i></a>
                    <a href="/pegawai/ajukan/delete/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='Hapus data' onclick="return confirm('Yakin ingin di hapus?');"><i class="fas fa-trash"></i></a>
                    @else
                      
                    <a href="/pegawai/ajukan/download/pdf/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='PDF' target="_blank"><i class="fas fa-file-pdf"></i></a>
                    
                    @endif
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