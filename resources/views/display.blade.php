@extends('layout.web')
@section('cssPage')
<style>
    .ex1 {
        /* background-color: lightblue; */
        height: 400px;
        overflow: auto;
    }
</style>
@endsection
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')
<div class="container p-0 m-0 ">
    <div class="container rounded-pill p-2 mb-3" style="background-color: #ffff">
        <h1 class="text-center fw-bold"><img class="me-2" src="{{asset('img/confetti.png')}}" height="40px"> PEMENANG
            DOORPRIZE BULAN K3 PT JMTM <img class="ms-2" src="{{asset('img/confetti.png')}}" height="40px"
                style="transform: scaleX(-1);"></h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg h-100" style="border-radius:20px;">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center rounded-pill border-none"
                        style="background-color:#277BC0;padding:10px;">
                        {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                        <h4 class="text-light" id="hadiahName">Hadiah</h4>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="height:400px;">
                        {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                        {{-- <h4 class="text-light" id="hadiahName">Hadiah</h4> --}}
                        <div class="col text-center mt-5  p-1" id="gambarHadiah"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card shadow-lg h-100" style="border-radius:20px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center rounded-pill border-none"
                            style="background-color:#277BC0;padding:10px;border-radius:30px;border:none;">
                            {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                            <h4 class="text-light">List Pemenang</h4>
                        </div>
                        <div class="mt-4 px-2 d-flex justify-content-start align-items-start p-0">
                            <div class="text-center">
                                {{-- <div id="myDIV"> --}}
                                    {{-- <div class=>Lorem ipsum dolor sit amet, consectetutpat.</div> --}}
                                    <h3 id="pemenangName" class="ex1 text-start" style="font-size: 18pt;"></h3>
                                    {{--
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection
    @section('jsPage')
    <script>
        // Fungsi untuk memperbarui tampilan berdasarkan data dari server
        function updateDisplay(response) {
            
            updateDisplay(response);
            // Set hadiahName ke teks pesertaDaftar
            $('#hadiahName').empty();
            $('#hadiahName').text(response.hadiah.nama_hadiah);

            if (response.hadiah.foto) {
                var fotoUrl = response.hadiah.foto;
                $('#gambarHadiah').html('<img src="/foto/' + fotoUrl + '" width="300px" alt="Foto Hadiah">');
                // $('#gambarHadiah').html('<img src="https://event.jmtm.co.id/laravel/public/foto/' + fotoUrl + '" width="300px" alt="Foto Hadiah">');
            } else {
                $('#gambarHadiah').html('Foto tidak tersedia.');
            }

            var namaArray = response.pesertaDaftar;
            var orderedList = $('<ol>'); // Membuat elemen <ol> baru
            $.each(namaArray, function(index, element) {
                var listItem = $('<li>').text(element.nama);
                orderedList.append(listItem);
            });
            $('#pemenangName').empty().append(orderedList);
        }

        // Fungsi untuk melakukan polling setiap detik
        function pollForUpdates(statusAwal) {
            var nilai = statusAwal
            $.ajax({
                url: '{{ route('admin.ambil.display') }}',
                method: 'GET',
                success: function (response) {
                    nilai = response.pesertaDaftar[0].id_hadiah
                    console.log(statusAwal + '  ----  ' +nilai);
                    if (nilai != response.pesertaDaftar[0].id_hadiah) {
                        // alert('Selamat kepada Pemenang');
                        nilai = response.pesertaDaftar[0].id_hadiah
                        
                        // update hadiah..
                        // updateDisplay(response);
                    }else{

                    }
                    // kirim
                    updateDisplay(response);
                    console.log(response.pesertaDaftar);
                },
                error: function (error) {
                    console.error('Error:', error);
                    
                },
                complete: function () {
                    setTimeout(pollForUpdates(nilai), 1000); // Polling setiap detik
                }
            });
        }

        // Memulai polling pertama kali
        $(document).ready(function () {
            
            var statusAwal = 0
            pollForUpdates(statusAwal);
        });
    </script>
    @endsection