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
                      <h3 class="widget-user-username">{{Auth::user()->kadinkes->nama}} - Kepala Dinas Kesehatan Kota Banjarmasin</h3>
                      <h5 class="widget-user-desc"></h5>
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
                  <h3>{{$data->count()}}</h3>
                  
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
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
                  <th>Proses Persetujuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @php
                  $no =1;
              @endphp
              <tbody>
                @foreach ($data as $item)
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
                    {{$item->jabatan == null ? '': $item->jabatan->nama}}
                  </td>
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
                    <ul>
                    @foreach (collect(json_decode($item->proses_setuju)) as $item2)
                        <li>{{$item2->nama}} - {{$item2->status}}</li>
                    @endforeach
                    </ul>
                  </td>
                  <td>
                      
                    @if ($item->status == NULL)
                    <a href="#" class="btn btn-xs btn-success disetujui" data-id="{{$item->id}}" data-toggle="tooltip" title='Setujui'><i class="fas fa-check"></i></a>
                    <a href="#" class="btn btn-xs btn-danger ditolak" data-id="{{$item->id}}" data-toggle="tooltip" title='Tolak'><i class="fas fa-times"></i></a>
                    @else
                    <a href="/kadis/download/pdf/{{$item->id}}" class="btn btn-xs btn-danger" data-toggle="tooltip" title='PDF' target="_blank"><i class="fas fa-file-pdf"></i></a>
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

<div class="modal fade" id="modal-setuju">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">Di Setujui</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <form method="post" action="/kadis/validasi/setujui">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <label>Catatan</label>
          <textarea class="form-control" rows="3" name="catatan" placeholder="Catatan...."></textarea>
          <input type="hidden" name="cuti_id" id="cuti_id_setuju">
        </div>
      </div>
      <div class="modal-footer justify-content-between bg-success">
        <button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Keluar</button>
        <button type="submit" class="btn btn-sm btn-outline-light"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tolak">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Di Tolak</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <form method="post" action="/kadis/validasi/tolak">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <label>Catatan</label>
          <textarea class="form-control" rows="3" name="catatan" placeholder="Catatan...."></textarea>
          <input type="hidden" name="cuti_id" id="cuti_id_tolak">
        </div>
      </div>
      <div class="modal-footer justify-content-between bg-danger">
        <button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Keluar</button>
        <button type="submit" class="btn btn-sm btn-outline-light"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@push('js')
<script>
  $(document).on('click', '.disetujui', function() {
    var cuti_id = $(this).data('id');
    $('#cuti_id_setuju').val(cuti_id);
    $('#modal-setuju').modal('show');
  });

  $(document).on('click', '.ditolak', function() {
    var cuti_id = $(this).data('id');
    $('#cuti_id_tolak').val(cuti_id);
    $('#modal-tolak').modal('show');
  });
</script>
@endpush