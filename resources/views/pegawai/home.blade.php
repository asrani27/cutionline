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
                    <div class="widget-user-header bg-info">
                      <div class="widget-user-image">
                        <img class="img-circl elevation-2" src="/theme/logo.png" alt="User Avatar">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username">Selamat Datang, {{Auth::user()->name}}</h3>
                      <h5 class="widget-user-desc">{{Auth::user()->pegawai->skpd == null ? '-': Auth::user()->pegawai->skpd->nama}}</h5>
                    </div>
                    
                  </div>
            </div>
        </div>
        
        
    </div>
</div>
@endsection

@push('js')
    
@endpush