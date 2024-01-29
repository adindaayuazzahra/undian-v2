@extends('layout.web')
@section('navbar')
@include('partials.navbar')
@endsection

@section('content')
<!-- Halaman dengan tombol trigger dan pilih hadiah -->
<button id="triggerButton">Munculkan Pemenang</button>
<!-- Dropdown untuk memilih hadiah -->
<select id="hadiahDropdown"></select>
@endsection

@section('jsPage')
<script>
    $(document).ready(function () {
        // Menggunakan Ajax untuk mengambil data hadiah dari server
        $.ajax({
            url: "{{ route('admin.ambil.hadiah') }}",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                // Mengisi dropdown hadiah dengan opsi dari response hadiah
                $('#hadiahDropdown').empty(); // Mengosongkan dropdown sebelum mengisinya kembali
                $.each(response.hadiah, function (index, hadiah) {
                    $('#hadiahDropdown').append('<option value="' + hadiah.id + '">' + hadiah.nama_hadiah + '</option>');
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

        // Menambahkan event listener untuk tombol trigger
        $('#triggerButton').click(function () {
            // Mendapatkan nilai hadiah yang dipilih dari dropdown
            var selectedHadiah = $('#hadiahDropdown').val();

            // Menggunakan Ajax untuk memanggil endpoint di server dengan hadiah yang dipilih
            $.ajax({
                url: '/display/' + selectedHadiah,
                type: 'GET',
                success: function (data) {
                    console.log(data.message);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>


@endsection