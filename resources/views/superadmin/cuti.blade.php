@extends('layouts.app')

@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">LAPORAN CUTI</h3>

        </div>
        <form method="get" action="/superadmin/datacuti/search">
        <div class="card-body">
          <div class="row">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">Mulai</label>
              <div class="col-sm-9">
                <input type="date" name="mulai" class="form-control" value="{{old('mulai')}}" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">S/D</label>
              <div class="col-sm-9">
                <input type="date" name="sampai" class="form-control" value="{{old('sampai')}}" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-info" name="button" value="1">Tampilkan</button>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-danger" name="button" value="2">PDF</button>
              </div>
            </div>
            
          </div>
        </div>
        </form>
      </div>
      
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
                  <th>NIP/NIK/Nama/Jabatan</th>
                  <th>Instalasi</th>
                  <th>Ruangan</th>
                  <th>Tgl Mulai</th>
                  <th>Tgl Sampai</th>
                  <th>Lama</th>
                  <th>Status</th>
                  <th>Pengganti</th>
                  <th>Proses Persetujuan</th>
                  <th>Proses Berada Di</th>
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
                  <td>{{\Carbon\Carbon::parse($item->mulai)->format('d-m-Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($item->sampai)->format('d-m-Y')}}</td>
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
                    {{$item->proses_status}}
                  </td>
                  <td>
                    @if ($item->status == 1)
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