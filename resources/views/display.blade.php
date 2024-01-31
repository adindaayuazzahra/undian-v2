@extends('layout.web')
@section('cssPage')
<style>
    /* .body {
        background-color: #277BC0;
        background-image: url()
    } */
    #confetti {
        position: absolute;
        top: 0;
        left: 0;
        /* z-index: 1; */
    }

    .glass {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.44);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .glassAbu {
        /* From https://css.glass */
        background: rgba(95, 86, 86, 0.44);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(95, 86, 86, 0.3);
    }

    .glassKuning {
        /* From https://css.glass */
        background: rgba(23, 147, 223, 0.44);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(223, 190, 23, 0.3);
    }


    .ex1 {
        /* background-color: lightblue; */
        height: 400px;
        overflow: auto;
    }

    .bounce {
        position: relative;
        /* left: 50%; */
        bottom: 0;
        /* margin-top: -25px; */
        /* margin-left: -25px; */
        /* height: 50px; */
        /* width: 250px; */
        /* background: red; */
        -webkit-animation: bounce 1s infinite;
    }

    .goyang {
        position: relative;
        /* left: 50%; */
        bottom: 0;
        /* margin-top: -25px; */
        /* margin-left: -25px; */
        /* height: 50px; */
        /* width: 250px; */
        /* background: red; */
        -webkit-animation: heartBeat 1s infinite;
    }

    .zooms {
        position: relative;
        /* left: 50%; */
        bottom: 0;
        /* margin-top: -25px; */
        /* margin-left: -25px; */
        /* height: 50px; */
        width: 250px;
        /* background: red; */
        -webkit-animation: animate__rubberBand 1s infinite;
    }

    .bounceget {
        position: relative;
        /* left: 50%; */
        bottom: 0;
        /* margin-top: -25px; */
        /* margin-left: -25px; */
        /* height: 50px; */
        width: 250px;
        /* background: red; */
        -webkit-animation: bounce 1s infinite;
    }

    @-webkit-keyframes bounce {
        0% {
            bottom: 2px;
        }

        25%,
        75% {
            bottom: 12px;
        }

        50% {
            bottom: 17px;
        }

        100% {
            bottom: 0;
        }
    }
</style>
@endsection
@section('navbar')
@include('partials.navbar')
@endsection
@section('content')



<!-- gagal input-->
<canvas id="confetti"></canvas>
<div class="modal fade dialogbox" id="rollingDoor" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="">
            <div id="closekocok" style="text-align: right;margin: 5px;">
                <ion-icon name="close-outline" data-dismiss="modal"></ion-icon>
            </div>
            <div class="modal-body" style="font-size: 12px;" id="">
                <div style="text-align: center;margin-top: 10%;margin-bottom: 5%;" class="">
                    <img src="https://eber.co/wp-content/uploads/2020/05/ezgif.com-crop.gif" alt="image" class=""
                        style="width: 450px;">
                </div>
                <hr>
                <center>
                    <h1 class="bounce">Rolling Prize</h1>
                    <p style="font-weight: 900;
                  font-size: 10px;
                  margin-top: 23px;
                  margin-bottom: 5px;">Siapa pemenangnya..</p>
                </center>

            </div>
            <div class="modal-footer" style="background-color: rgb(128, 0, 0);" id="">
                <div class="btn-inline">
                    <!-- <a class="btn" id="readytoroll" style="font-weight: 900;color: white;">ROLL</a> -->
                    <a class="btn" style="font-weight: 900;color: white;" data-dismiss="modal">
                        <ion-icon name="close-circle-outline"></ion-icon> Tutup
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * end gagal input -->
<div class="container p-0 m-0">
    <div class="container rounded-pill p-2 mb-3 glass">
        <h1 class="text-center fw-bold sample goyang"><img class="me-2" src="{{asset('img/confetti.png')}}"
                height="40px">
            PEMENANG
            DOORPRIZE BULAN K3 PT JMTM <img class="ms-2" src="{{asset('img/confetti.png')}}" height="40px"
                style="transform: scaleX(-1);"></h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg h-100 glassKuning" style="border-radius:20px;">
                <div class="card-body">

                    <div class="d-flex justify-content-center align-items-center" style="height:400px;">
                        {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                        {{-- <h4 class="text-light" id="hadiahName">Hadiah</h4> --}}
                        <div class="col text-center mt-5  p-1 bounceget" id="gambarHadiah"></div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center border-none"
                        style="background-color:#277BC0;padding:10px;border-radius:25px 0px 25px 0px ;">
                        {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                        <h4 class="text-light" id="hadiahName">Hadiah</h4>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card shadow-lg h-100 glassKuning" style="border-radius:20px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center rounded-pill border-none"
                            style="background-color:#277BC0;padding:10px;border-radius:30px;border:none;">
                            {{-- <h4 id="nilaiPilihan" class="font-weight-bold text-center"></h4> --}}
                            <h4 class="text-light">List Pemenang</h4>
                        </div>
                        <div class="mt-4 px-2 d-flex justify-content-start align-items-start p-0" id="hidds">
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
    <audio src="{{asset('sound/rolling.mp3')}}" style="display: none;" id="rolls" type="audio/mpeg"></audio>
    <audio src="{{asset('sound/congrats.mp3')}}" style="display: none;" id="cong" type="audio/mpeg"></audio>
    @endsection
    @section('jsPage')

    <script>
        function Confetti() {
    //canvas init
    var canvas = document.getElementById("confetti");
    var ctx = canvas.getContext("2d");

    //canvas dimensions
    var W = window.innerWidth;
    var H = window.innerHeight;
    canvas.width = W;
    canvas.height = H;
    
    //particles
    var mp = 150; //max particles
    var types = ['circle', 'circle', 'triangle', 'triangle', 'line'];
    var colors = [
        [238, 96, 169],
        [68, 213, 217],
        [245, 187, 152],
        [144, 148, 188],
        [235, 234, 77]
    ];
    var angles = [
        [4,0,4,4],
        [2,2,0,4],
        [0,4,2,2],
        [0,4,4,4]
    ]
    var particles = [];
    for (var i = 0; i < mp; i++) {
        particles.push({
        x: Math.random() * W, //x-coordinate
        y: Math.random() * H, //y-coordinate
        r: Math.random() * 4 + 1, //radius
        d: Math.random() * mp, //density
        l: Math.floor(Math.random()*65+-30), // line angle
        a: angles[Math.floor(Math.random()*angles.length)], // triangle rotation
        c: colors[Math.floor(Math.random()*colors.length)], // color
        t: types[Math.floor(Math.random()*types.length)] //shape 
        })
    }
    
    function draw(){
        ctx.clearRect(0, 0, W, H);
        

        for (var i = 0; i < mp; i++) {
        var p = particles[i];
        var op = (p.r <= 3) ? 0.4 : 0.8;
        
        if (p.t == 'circle'){
            ctx.fillStyle = "rgba(" + p.c + ", "+ op +")";
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2, true);
            ctx.fill();
        } else if (p.t == 'triangle'){
            ctx.fillStyle = "rgba(" + p.c + ", "+ op +")";
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(p.x + (p.r*p.a[0]), p.y + (p.r*p.a[1]));
            ctx.lineTo(p.x + (p.r*p.a[2]), p.y + (p.r*p.a[3]));
            ctx.closePath();
            ctx.fill(); 
        } else if (p.t == 'line') {
            ctx.strokeStyle = "rgba(" + p.c + "," + op +")";
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(p.x + p.l, p.y + (p.r * 5));
            ctx.lineWidth = 2;
            ctx.stroke();
        } 

        }
        update();
    }



    function update() {

        for (var i = 0; i < mp; i++) {
        var p = particles[i];
        p.y += Math.cos(p.d) + 1 + p.r / 2;
        p.x += Math.sin(0) * 2;
        
        if (p.x > W + 5 || p.x < -5 || p.y > H) {
            particles[i] = {
            x: Math.random() * W,
            y: -10,
            r: p.r,
            d: p.d,
            l: p.l,
            a: p.a,
            c: p.c,
            t: p.t
            };
        }
        }
    }

    //animation loop
    setInterval(draw, 23);

    }

    window.onload = function(){
      Confetti();
    
      window.resizeWindow = function() {
        Confetti();
      };

      window.addEventListener('resize', resizeWindow, false);
    }







        // Fungsi untuk memperbarui tampilan berdasarkan data dari server
        function updateDisplay(response) {
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
                    // kirim
                    
                    updateDisplay(response);
                    // console.log(response.pesertaDaftar);
                },
                error: function (error) {
                    console.error('Error:', error);
                    
                },
                complete: function (response) {
                    // console.log(response.responseJSON.pesertaDaftar)
                    
                    // console.log(statusAwal + '  ----  ' +nilai);
                    
                    if (nilai != response.responseJSON.pesertaDaftar[0].id_hadiah) {
                        if (nilai != 0) {
                            var elementToHide = document.getElementById('hidds');
                            // Menyembunyikan elemen dengan mengatur display menjadi 'none'
                            elementToHide.style.display = 'none';
                            $('#rollingDoor').modal('show');
                            $('#rolls')[0].play();
                            setTimeout(() => {
                                $('#rollingDoor').modal('hide');
                                $('#cong')[0].play();
                                Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Success",
                                text:"Selamat kepada para pemenang..",
                                showConfirmButton: false,
                                timer: 4500
                                });
                                setTimeout(() => {
                                    
                                }, 6000);
                                elementToHide.style.display = 'block';
                            }, 5000);
                        }
                        nilai = response.responseJSON.pesertaDaftar[0].id_hadiah
                    }else{

                    }                    
                    setTimeout(pollForUpdates(nilai), 2000); // Polling setiap detik
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