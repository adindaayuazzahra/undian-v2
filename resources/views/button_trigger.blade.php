@extends('layout.web')
@section('cssPage')
<style>
    body {
        /* text-align:center; */
        background-color: #ffcc8e !important;
    }

    .button {
        position: relative;
        display: inline-block;
        margin: 20px;
    }

    .button a {
        color: white;
        font-family: Helvetica, sans-serif;
        font-weight: bold;
        font-size: 36px;
        text-align: center;
        text-decoration: none;
        background-color: #FFA12B;
        display: block;
        position: relative;
        padding: 20px 40px;

        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        text-shadow: 0px 1px 0px #000;
        filter: dropshadow(color=#000, offx=0px, offy=1px);

        -webkit-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;
        -moz-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;
        box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;

        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }

    .button a:active {
        top: 10px;
        background-color: #F78900;

        -webkit-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #915100;
        -moz-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3pxpx 0 #915100;
        box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #915100;
    }

    .button:after {
        content: "";
        height: 103px;
        width: 103%;
        /* Lebar sebelah kanan dan kiri */
        padding: 4px;
        position: absolute;
        bottom: -15px;
        left: -4px;
        right: 100px;
        /* Pusatkan sebelah kanan dan kiri */
        z-index: -1;
        background-color: #2B1800;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 10px;
    }
</style>
@endsection
@section('navbar')
@include('partials.navbar')
@endsection

@section('content')

<div class="row text-center">

    <div class="selectbox">
        <span></span>
        <select class="form-select" aria-label="Default select example" id="hadiahDropdown">
        </select>
    </div>
    <div id="triggerButton" ontouchstart="">
        <div class="button">
            <a href="#">LET'S GO</a>
        </div>
    </div>
</div>

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