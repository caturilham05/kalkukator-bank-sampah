@extends('admin.layout.admin')

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/contact">{{$title}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <span>{{ session('success') }}</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif

  <a href="{{route('admin.kategori.create')}}">
    <button type="submit" class="btn btn-primary mb-3" style="width: 25%"><i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Kategori Bank Sampah</button>
  </a>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if (empty($items))
            <center>
              <span>Data tidak ditemukan</span>
            </center>
          @else            
            <table class="table table-bordered">
              <thead>
                <tr>
                  {{-- <th style="width: 10px">#</th> --}}
                  <th>Nama Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->nama}}</td>
                        <td class="text-center">
                            {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="" method="POST"> --}}
                            <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{$item->nama}}?');" action="{{ route('admin.kategori.delete', $item->id) }}" method="POST">
                                <a href="{{ route('admin.kategori.update', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      @if (!empty($items))
        <div class="card-footer clearfix">
          {!! $items->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
      @endif
    </div>
  </div>
@endsection
