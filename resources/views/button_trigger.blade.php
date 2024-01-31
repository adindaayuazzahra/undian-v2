@extends('layout.web')
@section('cssPage')
<style>
    #confetti {
        position: absolute;
        top: 0;
        left: 0;
        /* z-index: 1; */
    }

    @font-face {
        font-family: 'gameFont';
        src: url('{{asset("PressStart2P-Regular.ttf")}}') format('woff2');
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


    #triggerButton.judul {
        font-family: 'gameFont', sans-serif;
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

<canvas id="confetti"></canvas>
<div class="row text-center glass mt-5">

    <h1 class="text-danger bold" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> "PRESS BUTTON
        HERE"
    </h1>

    <div class="selectbox h-100">
        <span></span>

        <select class="form-select btn btn-success" aria-label="Default select example" id="hadiahDropdown">
        </select>
    </div>
    <audio src="{{asset('sound/ding.mp3')}}" style="display: none;" id="rolls" type="audio/mpeg"></audio>
    {{-- <audio src="{{asset('sound/congrats.mp3')}}" style="display: none;" id="cong" type="audio/mpeg"></audio> --}}
    <br>
    <br>
    <div id="triggerButton" ontouchstart="">
        <div class="button judul animate__animated animate__bounce animate__delay-2s" style="width: 400px;">
            <a href="#" id="tombol">LET'S GO</a>
        </div>
    </div>
</div>

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
            // alert('sss')
            $('#rolls')[0].play();
            $('#tombol').text("Waiting Roll..");
            setTimeout(() => {
                 // Mendapatkan nilai hadiah yang dipilih dari dropdown
                var selectedHadiah = $('#hadiahDropdown').val();
                var status = 1;
                // Menggunakan Ajax untuk memanggil endpoint di server dengan hadiah yang dipilih
                $.ajax({
                    url: '/display/' + selectedHadiah + '/' + status,
                    type: 'GET',
                    data: {
                        status: 1,
                    },
                    success: function (data) {
                        console.log(data.message);
                    },
                    error: function (error) {
                        console.log(error)
                        console.error('Error:', error);
                    }
                });
                // $('#cong')[0].play();
                setTimeout(() => {
                    $('#tombol').text("LET'S GO");
                }, 4000);
                
            }, 1000);
            
        });
    });
</script>


@endsection