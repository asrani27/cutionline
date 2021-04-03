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
        <h4>SETTING KA.INSTALASI  RSUD SULTAN SURIANSYAH</h4>
        <div class="row">
            <div class="col-12">
                <a href="/superadmin/manajemen/instalasi" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
              <br/><br/>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">SETTING KA.INSTALASI RSUD SULTAN SURIANSYAH</h3>
  
                </div>
                
                <form method="POST" action="/superadmin/manajemen/instalasi/kepala">
                    @csrf
                    @method('PUT')

                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap table-sm table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Instalasi</th>
                        <th>Kepala Instalasi</th>
                      </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                            <input type="hidden" name="instalasi_id[]" value="{{$item->id}}">
                            <select class="form-control" name="pegawai_id[]">
                                <option value="">-pilih-</option>
                                @foreach ($pegawai as $item2)
                                <option value="{{$item2->id}}" {{$item2->id == $item->kai ? 'selected':''}}>{{$item2->nip}} - {{$item2->nama}}</option>
                                @endforeach
                            </select>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                    
                  </table>
                  {{--   --}}
                </div>
                <button type="submit" class="btn btn-block btn-success"><i class="fas fa-save"></i> Simpan</button>
                
                </form>
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')


@endpush