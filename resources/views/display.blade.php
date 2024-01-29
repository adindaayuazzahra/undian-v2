@extends('layout.web')
@section('navbar')
@include('partials.navbar');
@endsection
@section('content')
<div class="container bg-success d-flex flex-column justify-content-center align-items-center">
    <div class="col">
        <div class="row">
            <h1>PEMENANG DOORPRIZE BULAN K3 PT JMTM</h1>
        </div>
        <p id="hadiahName"></p>
        <h1>Pemenang:</h1>
        <p id="pemenangName"></p>
    </div>
</div>
@endsection
@section('jsPage')
<script>
    // Fungsi untuk memperbarui tampilan berdasarkan data dari server
        function updateDisplay(response) {
            // Set hadiahName ke teks pesertaDaftar
            $('#hadiahName').empty();
            $('#hadiahName').append('<p>' + response.namaHadiah + '</p>');
            // Bersihkan dan isi pemenangName dengan nama peserta
            $('#pemenangName').empty();
            // $.each(response.pesertaDaftar, function (index, peserta) {
            //     $('#pemenangName').append('<p>' + peserta.nama + '</p>');
            // });
            $.each(response.pesertaDaftar, function (index, peserta) {
        var $namaPeserta = $('<p style="display: none;">' + peserta.nama + '</p>');
        $('#pemenangName').append($namaPeserta);
        $namaPeserta.fadeIn(1000 * (index + 1)); // Animasi muncul dengan durasi 1 detik per peserta
    });

        }

        // Fungsi untuk melakukan polling setiap detik
        function pollForUpdates() {
            $.ajax({
                url: '{{ route('admin.ambil.display') }}',
                method: 'GET',
                success: function (response) {
                    updateDisplay(response);
                    console.log(response.pesertaDaftar);
                },
                error: function (error) {
                    console.error('Error:', error);
                    
                },
                complete: function () {
                    setTimeout(pollForUpdates, 1000); // Polling setiap detik
                }
            });
        }

        // Memulai polling pertama kali
        $(document).ready(function () {
            pollForUpdates();
        });
</script>
@endsection