@extends('layout.web')
@section('navbar')
@include('partials.navbar')
@endsection

@section('content')
<div class="row-md-12">
    <div class="card shadow-lg" style="border-radius:20px;width:90vw;">
        <div class="card-body">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5><strong>Daftar Hadiah</strong></h5>
                    <div>
                        <a href="{{route('admin.home')}}" class="btn btn-secondary" style="border-radius: 5px;">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#hadiahAdd">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
                <table id="tabel_hadiah" class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Hadiah</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">sisa</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($hadiahs as $h)
                        <tr>

                            <td>{{$h->id}}</td>
                            <td>{{$h->nama_hadiah}}</td>
                            <td><img src="/foto/{{$h->foto}}" width="90px;"></td>
                            <td>{{$h->jumlah}}</td>
                            <td>
                                @if ($h->jumlah - $h->peserta->count())
                                {{ $h->jumlah - $h->peserta->count() }}
                                @else
                                Habis
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#hadiahEdit{{$h->id}}">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <a href="{{ route('hadiah.delete.do', ['id' => $h->id])}}" class="btn btn-danger"><i
                                        class="fa-regular fa-trash-can"></i></a>
                                <a href="{{ route('admin.generate.gift', ['id' => $h->id])}}"
                                    class="btn btn-secondary"><i class="fa-solid fa-gift"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal Hadiah ADD -->
<div class="modal fade text-dark" id="hadiahAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Tambah Hadiah</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hadiah.add.do')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_hadiah">Nama Hadiah</label>
                        <input type="text" class="form-control @error('nama_hadiah') is-invalid @enderror"
                            id="nama_hadiah" name="nama_hadiah">
                        @error('nama_hadiah')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                            name="jumlah">
                        @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Gambar Hadiah</label><br>
                        <input type="file" class=" @error('foto') is-invalid @enderror" id="foto" name="foto">
                        @error('foto')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hadiah EDIT -->
@foreach ($hadiahs as $h)
<div class="modal fade text-dark" id="hadiahEdit{{$h->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Hadiah</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hadiah.edit.do', [ 'id' => $h->id ])}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_hadiah_edit">Nama Hadiah</label>
                        <input type="text" class="form-control @error('nama_hadiah_edit') is-invalid @enderror"
                            id="nama_hadiah_edit" name="nama_hadiah_edit" value="{{$h->nama_hadiah}}">
                        @error('nama_hadiah_edit')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_edit">Jumlah</label>
                        <input type="text" class="form-control @error('jumlah_edit') is-invalid @enderror"
                            id="jumlah_edit" name="jumlah_edit" value="{{$h->jumlah}}">
                        @error('jumlah_edit')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_edit">Gambar Hadiah</label><br>
                        <input type="file" class=" @error('foto_edit') is-invalid @enderror" id="foto_edit"
                            name="foto_edit">
                        @error('foto_edit')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('jsPage')
@if ($errors->has('addHadiahErr'))
<script>
    $(document).ready(function() {
        $('#hadiahAdd').modal('show');
    });

</script>
@elseif ($errors->has('addHadiahErrEdit'))
<script>
    $(document).ready(function() {
        $('#hadiahEdit{{$h->id}}').modal('show');
    });

</script>
@endif
<script>
    $(document).ready(function() {
        $('#tabel_hadiah').DataTable({
            pageLength: 10, // Jumlah entri per halaman
            lengthMenu: [10, 15], // Opsi jumlah entri per halaman yang dapat dipilih
        });
    })

</script>

@endsection