@extends('layouts.app')

@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DATA TANDA TANGAN</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              @php
                  $no =1;
              @endphp
              <tbody>
                @foreach ($data as $item)
                <tr>
                  <td>{{$no++}}</td>
                  <td><img src="/storage/ttd/{{$item->file}}" width="100"> </td>
                  <td>{{$item->nama}}</td>
                
                  <td>
                    <a href="/superadmin/ttd/upload/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Upload TTD'><i class="fas fa-upload"></i></a>
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


<div class="row">
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DATA KEPALA DINAS KESEHATAN</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap table-sm table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
              @foreach ($kadinkes as $item)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$item->nip}}</td>
                <td>{{$item->nama}}</td>
              
                <td>
                  <a href="/superadmin/ttd/kadinkes/{{$item->id}}" class="btn btn-xs btn-success" data-toggle="tooltip" title='Data Kadinkes'><i class="fas fa-edit"></i></a>
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