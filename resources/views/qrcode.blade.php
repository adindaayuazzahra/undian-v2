@extends('layout.web')
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
<div class="container">
    <div class="mb-3 d-flex justify-content-center">
        <div class="text-center" style="padding: 20px; border-radius: 20px;background-color:white; width:300px;">
            <img width="100%" src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(300)->generate($peserta->npp)) }}" alt="QR Code">
        </div>
    </div>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <h4 class="mb-0 fw-bold">{{$peserta->nama}}</h4>
        <h4 class="mb-0">{{$peserta->npp}}</h4>
    </div>
    @if ($peserta->id_hadiah)
    {{-- <div class="d-flex mt-2 flex-column align-items-center justify-content-center"> --}}
        <div class="rounded-pill bg-success p-3 mt-3">
            <h6 class="mb-0 fw-bold text-center">Selamat Anda Mendapatkan hadiah <strong>{{$peserta->hadiah->nama_hadiah}}</strong></h6>
        </div>
    {{-- </div> --}}
    @endif
    <div class="mt-3 d-flex justify-content-center">
        <a href="{{route('index')}}" class="btn btn-dark rounded-pill">Kembali</a>
    </div>
</div>
@endsection
