@extends('layout.web')
@section('cssPage')
<style>
    #preview video {
        transform: scaleX(-1);
    }
</style>
@endsection
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center">
    <div class="card bg-transparent">
        <div id="preview" style="width:50vw"></div>
        <form id="form" action="{{ route('redeem') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="npp" id="npp">
        </form>
        <!-- Button trigger modal -->
    </div>

    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#inputmanual">
        Input Manual
    </button>


    @if (session('error'))
    <div id="alertMessage" class="alert alert-{{ session('color') }} mt-3 rounded mx-2" role="alert">
        <h4 class="alert-heading">{{ session('head') }}</h4>
        <hr>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
    @endif
</div>

{{-- Modal Konfirmasi --}}
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4">
            <div class="d-flex text-center flex-column justify-content-center mb-3">
                <p class="mb-0">Redeem Code dengan NPP</p>
                <h4 id="confirmationNPP"></h4>
            </div>
            <div class="d-grid gap-2 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Redeem</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Input Manual -->
<div class="modal fade" id="inputmanual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-center mb-3">
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                <h5>Ikut Doorprize</h5>
            </div>
            <form method="POST" action="{{ route('redeem') }}">
                {{ csrf_field() }}
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="npp" name="npp" required autocomplete="off">
                    <label for="floatingInput">NPP</label>
                </div>
                <div class="d-grid gap-2 d-flex justify-content-center">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Input</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jsPage')
<script src="{{asset('js/html5-qrcode.min.js')}}"></script>
<script type="text/javascript">
    let html5QrcodeScanner = new Html5QrcodeScanner(
        "preview", { fps: 10,  qrbox: { width: 350, height: 350 }},
       false
    );

    html5QrcodeScanner.render(onScanSuccess);

    function onScanSuccess(decodedText) {
        console.log(decodedText);
        // Tampilkan modal konfirmasi
        document.getElementById('confirmationNPP').textContent = decodedText;
        $('#confirmationModal').modal('show');
    }

    function submitForm() {
        // Submit formulir setelah konfirmasi
        document.getElementById('npp').value = document.getElementById('confirmationNPP').textContent;
        document.getElementById('form').submit();
    }
</script>
<script>
    // Setelah halaman dimuat, atur timer untuk menyembunyikan pesan setelah 3 detik
    $(document).ready(function() {
        setTimeout(function() {
            $("#alertMessage").fadeOut("slow");
        }, 2000);
    });
</script>
{{-- <div class="container">
    <div class="card bg-white">
        <video id="preview"></video>
        <form id="form" action="{{route('redeem')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="npp" id="npp">
        </form>
    </div>
    @if (session('error'))
    <div class="alert alert-{{session('color')}} mt-3 rounded mx-2" role="alert">
        <h4 class="alert-heading">{{ session('head')}}</h4>
        <hr>
        <p class="mb-0">{{session('error')}}</p>
    </div>
    @endif
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4">
            <div class="d-flex text-center flex-column justify-content-center mb-3 ">
                <p class="mb-0">Redeem Code dengan NPP</p>
                <h4 id="confirmationNPP"></h4>
            </div>
            <div class="d-grid gap-2 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Redeem</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('jsPage')
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        console.log(content);
        // Tampilkan modal konfirmasi
        document.getElementById('confirmationNPP').textContent = content;
        $('#confirmationModal').modal('show');
    });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
    console.error(e);
    });

    // scanner.addListener('scan', function (c) {
    //     document.getElementById('npp').value = c;
    //     document.getElementById('form').submit();
    // })
    function submitForm() {
    // Submit formulir setelah konfirmasi
        document.getElementById('npp').value = document.getElementById('confirmationNPP').textContent;
        document.getElementById('form').submit();
    }
</script> --}}
@endsection