@extends('layout.web')
@section('content')
<div class="container col">
    <div class="row justify-content-center mb-3 d-grid gap-2">
        <a href="{{route('logout.do')}}" class="btn btn-danger btn-lg" style="border-radius:30px;">
            <h4>Logout <i class="fa-solid fa-right-from-bracket"></i></h4>
        </a>
    </div>
    <div class="row justify-content-center ">
        <a href="{{route('scann')}}" class="card mt-2 me-2 text-center btn text-white"
            style="width:350px;border-radius:10px;background-color: #277BC0">
            <div class="card-body">
                <h5>Scann QrCode</h5>
                <i class="fa-solid fa-qrcode mt-3" style="font-size: 30pt;"></i>
            </div>
        </a>
        <a href="{{route('admin.list_peserta')}}" class="card mt-2 me-2 text-center btn text-white"
            style="width:350px;border-radius:10px;background-color: #277BC0">
            <div class="card-body">
                <h5>List Peserta</h5>
                <i class="fa-solid fa-user-group mt-3" style="font-size: 30pt;"></i>
            </div>
        </a>
        <a href="{{route('admin.list_hadiah')}}" class="card mt-2 me-2 text-center btn text-white"
            style="width:350px;border-radius:10px;background-color: #277BC0">
            <div class="card-body">
                <h5>List Hadiah </h5><i class="fa-solid fa-gift mt-3" style="font-size: 30pt;"></i>
            </div>
        </a>
        {{-- <a href="" class="card mt-2 me-2 text-center btn text-white"
            style="width:350px;border-radius:10px;background-color: #277BC0">
            <div class="card-body">
                <h5>Generate Hadiah</h5>
                <i class="fa-solid fa-face-grin-wink mt-3" style="font-size: 30pt;"></i>
            </div>
        </a>
        <a href="" class="card mt-2 me-2 text-center btn text-white"
            style="width:350px;border-radius:10px;background-color: #277BC0">
            <div class="card-body">
                <h5>List Pemenang</h5>
                <i class="fa-solid fa-trophy mt-3" style="font-size: 30pt;"></i>
            </div>
        </a> --}}
    </div>
</div>

{{-- <a href="{{route('logout.do')}}" class="btn btn-danger">Logout</a> --}}
@endsection