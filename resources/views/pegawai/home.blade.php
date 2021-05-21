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
                        Karu {{Auth::user()->pegawai->karu->nama}}<br/>
                      @endif                        
                      @if (Auth::user()->pegawai->kai != null)
                        Kepala {{Auth::user()->pegawai->kai->nama}}
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
                    @if ($atasan == null && $manajemen == true)
                        
                      <h3 class="widget-user-username">Atasan : Kepala Dinas Kesehatan</h3>
                      <h5 class="widget-user-desc">Dinas Kesehatan</h5>
                    @elseif($atasan == null && $manajemen == false)

                      <h3 class="widget-user-username">Atasan : -</h3>
                      <h5 class="widget-user-desc">-</h5>
                    @else
                        
                      @if ($atasan->jenis == 'manajemen')
                    
                      <h3 class="widget-user-username">Atasan : {{count($atasan->pegawai) == 0 ? '-': $atasan->pegawai->first()->nama}}</h3>
                        <h5 class="widget-user-desc">{{$atasan->nama}}<br/>Manajemen</h5>
                        
                      @else
                      <h3 class="widget-user-username">Atasan : {{$atasan->nama}}</h3>
                        <h5 class="widget-user-desc">{{$atasan->jabatan == null ? '-': $atasan->jabatan->nama}}
                          -
                          @if ($atasan->karu != null)
                            Ka. Ruangan {{$atasan->karu->nama}}<br/>
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
                    @endif
                    
                    <h5 class="widget-user-desc">
                      
                    </h5>
                    
                  </div>
                  
                </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SISA CUTI TAHUNAN</span>
                <span class="info-box-number">
                  {{$sisaCuti}} Hari
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              
                <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/ajukan/cuti">
                  <i class="fas fa-edit"></i> FORM PENGAJUAN CUTI
                </a>
                
                <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/profil">
                  <i class="fas fa-user"></i> PROFIL
                </a>
                <a class="btn btn-app bg-gradient-info text-white" href="/pegawai/riwayat/cuti">
                  <i class="fas fa-file"></i> RIWAYAT CUTI
                </a>

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          
          <!-- /.col -->
        </div>
        @if (count($daftarCuti) != 0)
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
                  @foreach ($daftarCuti as $item)
                      
                  <tr style="font-size:12px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no++}}</td>
                    <td>{{$item->pegawai->nama}}<br/>
                      NIP/NIK.{{$item->pegawai->nip}}<br/>
                      @if ($item->pegawai->kai != null)
                          Ka. {{$item->instalasi}}
                      @endif
                      {{$item->jabatan == null ? '': $item->jabatan->nama}}
                    </td>
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
                          @if ($item->kabid_id != null)
                          <li>
                            Mengetahui : {{$item->kabid->nama}}
                          </li>
                          @endif
                      
                      </ul>
                    </td>
                    <td>
                      @if ($item->status == NULL)
                        @if (Auth::user()->pegawai->jabatan == null)
                        <a href="/pegawai/ajukan/validasi/setujui/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Setujui' onclick="return confirm('Yakin ingin di setujui?, setelah di setujui maka tidak dapat di ubah kembali');"><i class="fas fa-check"></i></a>
                        @else
                          @if(Auth::user()->pegawai->jabatan->skip == 1)
                          <a href="/pegawai/ajukan/validasi/setujui/skip/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Setujui' onclick="return confirm('Yakin ingin di setujui?, setelah di setujui maka tidak dapat di ubah kembali');"><i class="fas fa-check"></i></a>
                          @else
                          <a href="/pegawai/ajukan/validasi/setujui/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Setujui' onclick="return confirm('Yakin ingin di setujui?, setelah di setujui maka tidak dapat di ubah kembali');"><i class="fas fa-check"></i></a>

                          @endif  
                        @endif
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
                  <th>NIP/NIK/Nama/Jabatan</th>
                  <th>Instalasi</th>
                  <th>Ruangan</th>
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
                  <th>Pengganti</th>
                  <th>Proses Persetujuan</th>
                  <th>Status Berada Di</th>
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
                    @if ($item->pegawai->kai != null)
                        Ka. {{$item->instalasi}}
                    @endif
                    @if ($item->pegawai->karu != null)
                        Ka. {{$item->ruangan}}
                    @endif
                    {{$item->jabatan == null ? '':$item->jabatan->nama}}</td>
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
                    @if ($item->kabid_id != null)
                        <li>
                          Mengetahui : {{$item->kabid->nama}}
                        </li>
                    @endif
                    </ul>
                  </td>
                  <td>
                    {{$item->proses_status}}
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

<div class="modal fade show" id="modal-primary" style="display: block; padding-right: 16px;" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h4 class="modal-title">Di Setujui</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        Catatan : <textarea></textarea>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">keluar</button>
        <button type="button" class="btn btn-outline-light">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@push('js')
    
@endpush