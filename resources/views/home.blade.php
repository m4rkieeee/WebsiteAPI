@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>

            html {
                font-family: Fantasy;
            }
            div {
                z-index: 10;
            }
            #bgimage {
                z-index: 0;
                height: 100%;
                width: 100%;
                mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 50%);
            }
            .nav-wrapper{
                z-index: 99;
            }

            #youtube:hover, #github:hover, #youtube1:hover, #github1:hover, #youtube2:hover, #github2:hover
            {
                background-color: rgba(0,0,0,0.1);
                border-radius: 5px;
            }
            .card-action {
                text-align: center;
            }

            .card-title {
                text-align: center;
            }
            .card {

                user-select: none; /* supported by Chrome and Opera */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                -moz-user-select: none; /* Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
            }
            img {
                max-width: 100%;
                max-height: 100%;
            }
        </style>
    </head>

    <body>
    <img src="{{ asset('img/login.jpg') }}" id="bgimage" style=" position: absolute; background: linear-gradient(black, white)">
    <nav>
        <div class="nav-wrapper blue">

            <div class="container">
                <a href="./index.html" class="brand-logo">Fased</a>
                <a href="#" class="sidenav-trigger" data-target="slide_out"><i class="material-icons">menu</i></a>
                <ul class="hide-on-med-and-down right" id="navSelector">
                    <li class="active"><a href="../dashboard/index.html">Home</a></li>
                    <li><a href="../login/index.html">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="nav-wrapper">
        <ul class="sidenav blue" id="slide_out">
            <li class="active"><a href="#" class="white-text"><i class="material-icons white-text">home</i>Home</a></li>
            <li><a href="#" class="white-text"><i class="material-icons white-text">group</i>About</a></li>
            <li><a href="#" class="white-text"><i class="material-icons white-text">email</i>Contact</a></li>
            <li><a href="#" class="white-text"><i class="material-icons white-text">logout</i>Sign Out</a></li>

        </ul>
    </div>
    <div class="row">
        <div class="col s12 m6 l4">
            <div class="card white">
                <div class="card-content">
                    <span class="card-title">This is a website.</span>
                    <span class="card-content">Here I can input some text without any issues, because life is great.</span>
                    <br />
                    <span class="card-content">Want to know more? Don't be afraid to check my Youtube and Github below.</span>
                </div>
                <div class="card-action">
                    <a href="https://www.youtube.com/channel/UCQpvcYJ6fR5BXJbjl4NWoMw" id="youtube1" class="black-text"><b>Youtube</b></a>
                    <a href="https://github.com/m4rkieeee" id="github1" class="black-text"><b>Github</b></a>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card blue">
                <div class="card-content white-text">
                    <span class="card-title">This is a website.</span>
                    <span class="card-content">Here I can input some text without any issues, because life is great.</span>
                    <br />
                    <span class="card-content">Want to know more? Don't be afraid to check my Youtube and Github below.</span>
                </div>
                <div class="card-action">
                    <a href="https://www.youtube.com/channel/UCQpvcYJ6fR5BXJbjl4NWoMw" id="youtube" class="white-text"><b>Youtube</b></a>
                    <a href="https://github.com/m4rkieeee" id="github" class="white-text"><b>Github</b></a>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card blue">
                <div class="card-content white-text">
                    <span class="card-title">This is a website.</span>
                    <span class="card-content">Here I can input some text without any issues, because life is great.</span>
                    <br />
                    <span class="card-content">Want to know more? Don't be afraid to check my Youtube and Github below.</span>
                </div>
                <div class="card-action">
                    <a href="https://www.youtube.com/channel/UCQpvcYJ6fR5BXJbjl4NWoMw" id="youtube2" class="white-text"><b>Youtube</b></a>
                    <a href="https://github.com/m4rkieeee" id="github2" class="white-text"><b>Github</b></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 l4">
            <div class="card blue">
                <div class="card-image">
                    <img src="{{asset('img/pf-logo.jpg')}}">
                    <span class="card-title ">You can give this a title and it'll work. I wonder how long I can make this actually, any guesses?</span>
                </div>
                <div class="card-content white-text">
                    <span>I like writing this down in here so that I know how it will look like in the end, but apparently this isn't enough for a second row but maybe now?</span>
                </div>
            </div>
        </div>
        <div class="col s12 m6 l4">
            <div class="card blue">
                <div class="card-image blue waves-effect waves-block waves-light">
                    <img class="activator" src="{{asset('img/pf-logo.jpg')}}">
                </div>
                <div class="card-content">
                    <span class="card-title activator white-text text-darken-4">If you click this, it opens.<i class="material-icons right">more_vert</i></span>
                </div>
                <div class="card-reveal blue white-text">
                    <span class="card-title blue-text">If you hit the close icon, it closes.<i class="material-icons right white-text">close</i></span>
                    <p>I like writing this down in here so that I know how it will look like in the end, but apparently this isn't enough for a second row but maybe now?</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
    </body>
    </html>
@endsection
