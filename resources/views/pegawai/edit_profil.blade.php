@extends('layouts.app')

@push('css')

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    PROFIL PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Profil</h4>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username">{{strtoupper(Auth::user()->name)}}</h3>
                    <h5 class="widget-user-desc">NIP. {{strtoupper(Auth::user()->username)}}</h5>
                    </div>
                    <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/theme/man.png" alt="User Avatar">
                    </div>
                    <form method="POST" action="/pegawai/profil/edit">
                        @csrf
                        @method('PUT')
                    <div class="card-footer">
                    <div class="row">
                        <div class="col-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Unit Kerja</h5>
                            <span class="description-text">
                                <input type="text" name="unit_kerja" class="form-control" value="{{$data->unit_kerja}}">
                            </span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">TELP</h5>
                            <span class="description-text">
                                
                                <input type="text" name="telp" class="form-control" value="{{$data->telp}}">
                            </span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                        <div class="description-block">
                            <h5 class="description-header">TMT</h5>
                            <span class="description-text">
                                
                                <input type="date" name="tmt" class="form-control" value="{{$data->tmt}}">
                            </span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                    <button type="submit"  class="btn btn-block bg-gradient-success"><b>Update</b></button>
                    </form>
                </div>
              </div>
              
        </div>
        
    </div>
</div>
@endsection

@push('js')


@endpush