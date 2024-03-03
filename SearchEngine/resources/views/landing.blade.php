<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SearchBook</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/47a76e5697.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $("#search").click(function(){
                var cari = $("#cari").val();
                var rank = $("#rank").val();
                $.ajax({
                    url:'/search?q='+cari+'&rank='+rank,
                    dataType : "json",
                    success: function(data){
                        $('#content').html(data);
                    },
                    error: function(data){
                        alert("Please insert your command");
                    }
                });
            });
        });
    </script>

</head>
<body style="background-color: #222020;">

    <header>
        <nav style="background-color: #222020;" class="navbar navbar-expand-lg navbar-light shadow-sm rounded">
            <a class="navbar-brand text-white" href="#" style="font-family: Poppins;">220411100061<b> Ronggo Widjoyo</b></a>
        </nav>
    </header>

    <main role="main" style="height:200px; background-image: linear-gradient( rgb(0 0 0) 18.8%, #222020 100.2% );">
        <div class="container pt-5 w-50">
            <!-- Another variation with a button -->
            <form action="#" method="GET" onsubmit="return false" class="input-group">
                <select class="form-control" name="rank" id="rank" hidden>
                    <option value="20">20</option>
                </select>
                <input type="text" class="form-control rounded-left" placeholder="Search Movie" name="q" id="cari">
                <div class="input-group-append">
                    <button class="btn btn-secondary" id="search" type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </main>

    <div class="row m-4 align-items-center justify-content-center" id="content">
     
    </div>

</body>
</html>