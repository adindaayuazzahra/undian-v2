@extends('layout.web')
@section('content')
<div class="container justify-content-center col">
    <div class="row justify-content-center mb-4">
        <img src="{{asset('img/logojmtm.png')}}" class="mb-3" style="width:80vw;" alt="">
        <h3 class="text-center">Selamat Datang di Acara Peringatan Bulan K3 <strong>PT Jasamarga Tollroad
                Maintenance</strong></h3>
    </div>
    <div class="row justify-content-center">
        <a href="{{route('register')}}" class="btn mb-3 text-white rounded-pill"
            style="width:90vw;background-color: #277BC0;padding: 18px 30px 18px 30px">
            <div class="row d-flex justify-content-between ">
                <div class="col d-flex justify-content-start align-items-center">
                    <h5 class="fw-bold">Register Peserta</h5>
                </div>
                <div class="col-1 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </a>
        <!-- Button trigger modal -->
        <button type="button" class="btn mb-2 text-white rounded-pill" data-bs-toggle="modal"
            data-bs-target="#exampleModal" style="width:90vw;background-color: #277BC0;padding: 18px 30px 18px 30px">
            <div class="row d-flex justify-content-between ">
                <div class="col d-flex justify-content-start align-items-center">
                    <h5 class="fw-bold">Cetak QrCode</h5>
                </div>
                <div class="col-1 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </button>
        {{--
        <a href="" class="btn mb-2 text-white rounded-pill"
            style="width:90vw;background-color: #277BC0;padding: 18px 30px 18px 30px">
            <div class="row d-flex justify-content-between ">
                <div class="col d-flex justify-content-start align-items-center">
                    <h5 class="fw-bold">Cetak QrCode</h5>
                </div>
                <div class="col-1 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </a> --}}
    </div>

    @if (session('error'))
    <div class="alert alert-{{session('color')}} mt-3 rounded mx-2" role="alert">
        <h4 class="alert-heading">{{ session('head')}}</h4>
        <hr>
        <p class="mb-0">{{session('error')}}</p>
    </div>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-center mb-3">
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                <h5>Cetak QrCode Doorprize</h5>
            </div>
            <form method="GET" action="{{ route('cetak')}}">
                {{ csrf_field() }}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="npp" name="npp" required autocomplete="off">
                    <label for="floatingInput">NPP</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="passcode" name="passcode" required autocomplete="pff">
                    <label for="floatingInput">passcode</label>
                </div>

                <div class="d-grid gap-2 d-flex justify-content-center">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection