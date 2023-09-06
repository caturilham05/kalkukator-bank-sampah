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
                        <li class="breadcrumb-item"><a href="/admin/dashboard">{{$title}}</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.data.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            @if (empty($categories))
              <div class="mb-3">
                <span style="color: red;"><b>Kategori sampah tidak ditemukan. Silahkan tambah kategori terlebih dahulu</b></span>
                <a href="{{route('admin.kategori.create')}}" style="text-decoration: underline;"> Tambah Kategori Baru</a>
              </div>
            @else
              <div class="form-group">
                <label>Kategori Sampah</label>
                <select class="form-control" name="sampah_kategori_id">
                  @foreach ($categories as $kategori)
                    <option value="{{$kategori['id']}}">{{$kategori['nama']}}</option>
                  @endforeach
                </select>
              </div>
            @endif

            <div class="form-group">
              <label for="nama">Nama Sampah</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Sampah">
              @error('nama')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
            </div>

            <div class="form-group">
              <label for="harga">Harga Sampah</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="harga" name="harga" placeholder="Harga Sampah">
              @error('harga')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="satuan">Satuan (Kg)</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="satuan" name="satuan" placeholder="Satuan (Kg)">
              @error('satuan')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="foto">Foto Sampah</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto" name="foto">
                  <label class="custom-file-label" for="foto">Pilih Foto Sampah</label>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
@endsection