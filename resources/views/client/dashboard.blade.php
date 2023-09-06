@extends('client.layout.layout')

@section('content')
    <div class="card card-primary m-5">
        <div class="card-header">
          <center>
            <h3 class="card-title">Kalkulator Bank Sampah</h3>
          </center>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('sampah')}}" method="GET">
          {{-- @csrf --}}
          <div class="card-body">
            @if (empty($items))
              <div class="mb-3">
                <span style="color: red;"><b>Kategori sampah tidak ditemukan. Silahkan tambah kategori terlebih dahulu</b></span>
                <a href="{{route('admin.kategori.create')}}" style="text-decoration: underline;"> Tambah Kategori Baru</a>
              </div>
            @else
              <div class="form-group">
                <label>Pilih Kategori Sampah</label>
                <select class="form-control" name="sampah_kategori_id">
                  @foreach ($items as $kategori)
                    <option value="{{$kategori['id']}}">{{$kategori['nama']}}</option>
                  @endforeach
                </select>
              </div>
            @endif
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
@endsection
