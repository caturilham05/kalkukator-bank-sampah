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
      <form action="{{route('admin.data.update', $item['id'])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            @if (empty($categories))
              <div class="mb-3">
                <span style="color: red;"><b>Kategori sampah tidak ditemukan. Silahkan tambah kategori terlebih dahulu</b></span>
                <a href="{{route('admin.kategori.create')}}" style="text-decoration: underline;"> Tambah Kategori Baru</a>
              </div>
            @else
              <div class="form-group">
                <label>Kategori Sampah</label>
                <select class="form-control @error('sampah_kategori') is-invalid @enderror" name="sampah_kategori_id">
                  <option value="0">Pilih Kategori Sampah</option>
                  @foreach ($categories as $kategori)
                    <option value="{{$kategori['id']}}" {{ ( $kategori['id'] == $item['sampah_kategori_id']) ? 'selected' : '' }}>{{$kategori['nama']}}</option>
                  @endforeach
                </select>
                @error('sampah_kategori')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
              </div>
            @endif

          <div class="form-group">
            <label for="nama">Nama Sampah</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{old('nama', $item['nama'])}}" placeholder="Nama Bank Sampah">
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{old('deskripsi', $item['deskripsi'])}}" placeholder="Deskripsi">
          </div>

          <div class="form-group">
            <label for="harga">Harga Sampah</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{old('harga', $item['harga'])}}" placeholder="Harga">
          </div>

          <div class="form-group">
            <label for="satuan">Satuan (Kg)</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="{{old('satuan', $item['satuan'])}}" placeholder="Satuan">
          </div>

          <div class="form-group">
            <label for="foto">Foto Sampah</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto">
                <label class="custom-file-label" for="foto">Pilih Foto Sampah</label>
              </div>
            </div>
            <br>
            @if (!empty($item['foto']))
                <img src="{{ asset('/storage/sampah/'.$item['foto']) }}" class="rounded" style="width: 50%">
            @endif
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
      </form>
    </div>
@endsection