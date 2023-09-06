@extends('client.layout.layout')

@section('content')
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
                  <th>Kategori Sampah</th>
                  <th>Nama Sampah</th>
                  <th>Deskripsi Sampah</th>
                  <th>Harga Sampah</th>
                  <th>Satuan (Kg)</th>
                  <th>Foto Sampah</th>
                  <th>Hitung Harga</th>
                  <th>Total Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->nama_kategori}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->deskripsi}}</td>
                        <td id="harga_awal">{{$item->harga}}</td>
                        <td id="satuan">{{$item->satuan}}</td>
                        <td>
                          @if (!empty($item->foto))
                            <img src="{{ asset('/storage/sampah/'.$item->foto) }}" class="rounded" style="width: 150px">
                          @else
                            -
                          @endif
                        </td>
                        <td class="text-center">
								            <div class="form-group mb-3">
								              <input type="number" min="1" class="form-control" id="berat_sampah" name="berat_sampah" placeholder="Berat Sampah (Kg)">
								            </div>

                            {{-- <form method="GET"> --}}

                                {{-- <a href="{{ route('admin.data.update', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button> --}}
                            {{-- </form> --}}
                        </td>
                        <td id="total_harga">0</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
        <!-- /.card-body -->
      </div>
      {{-- @if (!empty($items))
        <div class="card-footer clearfix">
          {!! $items->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
      @endif --}}
      <!-- /.card -->
    </div>
  </div>
@endsection