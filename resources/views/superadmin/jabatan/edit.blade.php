@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="/theme/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    JABATAN
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">        
        <a href="/superadmin/manajemen/jabatan" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a><br/><br/>
        <div class="row">
            <div class="col-lg-12 col-12">             
                <div class="card card-info">
                    <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-th"></i> Tambah Jabatan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="/superadmin/manajemen/jabatan/edit/{{$ruangan->id}}/{{$jabatan->id}}">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Ruangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$ruangan->nama}}" required>
                        </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Atasan Langsung</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jabatan_id">
                                <option value="">-pilih-</option>
                                @foreach ($dataJab as $item)
                                <option value="{{$item->id}}" {{$jabatan->jabatan_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="{{$jabatan->nama}}" required>
                        </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Update</button>
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