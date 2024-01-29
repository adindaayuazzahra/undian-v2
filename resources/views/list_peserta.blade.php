@extends('layout.web')
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
<div class="card shadow-lg" style="border-radius:20px; width:90vw">
    <div class="card-body">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h3><strong>List Peserta</strong></h3>
                <div>
                    <a href="{{ route('admin.home') }}" class="btn btn-secondary" style="border-radius: 5px;">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pesertaAdd">
                        <i class="fa-solid fa-plus"></i>
                    </button> --}}
                </div>
            </div>
            {{-- @if (session('message'))
            <div class="alert alert-{{ session('message-class') }} alert-dismissible fade show" role="alert">
                <div> <i class="{{ session('icon') }} pr-2"></i>
                    {{ session('message') }}
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif --}}
            <table id="list" class="table text-white" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NPP</th>
                        <th>Nama</th>
                        <th>Unit Kerja</th>
                        <th>Status</th>
                        <th>Hadiah</th>
                        {{-- <th width="11%">Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertas as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->npp }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->unit }}</td>
                        <td>
                            @if ($p->status == 0)
                            <div class="badge rounded-pill text-bg-primary">Hadir</div>

                            @elseif($p->status == 1)

                            <div class="badge rounded-pill text-bg-warning">Hadir & Ikut Doorprize</div>
                            @elseif($p->status == 2)

                            <div class="badge rounded-pill text-bg-success">Hadir & Menang Doorprize</div>
                            @endif
                        </td>
                        <td>
                            @if ($p->id_hadiah)
                            {{$p->hadiah->nama_hadiah}}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
@section('jsPage')
<script>
    $(document).ready(function() {
        $('#list').DataTable({
            responsive: true, // Opsi jumlah entri per halaman yang dapat dipilih
            pageLength: 8, // Jumlah entri per halaman
            lengthMenu: [5, 8]
        , });
    })
</script>
@endsection