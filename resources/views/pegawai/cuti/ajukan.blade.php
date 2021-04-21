@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    AJUKAN CUTI
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">        
        <a href="/pegawai/home" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
        <div class="row">
            <div class="col-lg-12 col-12">             
                <div class="card card-info">
                    <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-th"></i> Ajukan Cuti</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="/pegawai/ajukan/cuti">
                        @csrf
                    <div class="card-body">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pegawai</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$pegawai->nama}}" readonly>
                            <input type="hidden" class="form-control" name="pegawai_id" value="{{$pegawai->id}}" readonly>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nip" value="{{$pegawai->nip}}" readonly>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tgl Mulai Cuti</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="mulai" required>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tgl Berakhir Cuti</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="sampai" required>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Cuti</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_cuti_id" required>
                            <option value="">-pilih-</option>
                            @foreach ($jeniscuti as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alasan Cuti</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="alasan" required></textarea>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat Selama Cuti</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp" required>
                        </div>
                        </div>
                        
                        {{-- Pengganti --}}
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <strong>Data Pengganti. (Jika Tidak Ada Pengganti, Kosongkan saja).</strong>
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dari</label>
                        <div class="col-sm-10">
                            <select name="dari" class="form-control">
                                <option value="">-pilih-</option>
                                <option value="1">Dari Dalam Rumah Sakit</option>
                                <option value="2">Dari Luar Rumah Sakit</option>
                            </select>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NIK Pengganti</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nik_p">
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pengganti</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_p">
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Telp Pengganti</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telp_p">
                        </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                    <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('js')


@endpush