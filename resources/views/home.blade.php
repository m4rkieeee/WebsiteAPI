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
                    <li><a data-bs-toggle="modal" data-bs-target="#addPostModal">New Post</a></li>
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
        @foreach($todo as $todos)
        <div class="col s12 m6 l4">
            <div class="card white">
                <div class="card-content">
                    <span class="card-title">{{ $todos->taskName }}</span>
                    <span class="card-content"><b>{{ $todos->taskDescription }}</b></span>
                    <br />
                    <br />
                    <span class="card-content">Starting: {{ $todos->startdate->format('d F Y, H:i') }}</span>
                    <br />
                    <span class="card-content">Ending: {{ $todos->enddate->format('d F Y, H:i') }}</span>
                    <button type="button" class="btn-small right">Done?</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(Auth()->check())
        <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="type" value="addPost">
                        <div class="form-group">
                            <label for="todoTaskName">Post Title</label>
                            <input type="text" class="form-control" id="todoTaskName" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="todoTaskDescription">Post Text</label>
                            <textarea type="text" class="form-control" id="todoTaskDescription" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addPost" data-bs-dismiss="modal">Add Post</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#addPost').on('click', function () {
                $.ajax({
                    url: "{{ route('todo.actions') }}",
                    type: 'POST',
                    data: {
                        type: 'addPost',
                        postTitle: $('#todoTaskName').val(),
                        postText: $('#todoTaskDescription').val(),
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        console.log(data);
                        $('#postRows').append(
                            ' <div class="row mt-2 rounded">\
                                <div class="col-xl-8 mx-auto border border-dark p-3 pb-0 rounded">\
                                     <p style="margin-bottom:-2px;"><i class="fa-regular fa-file fa-lg me-1"></i><a href="/post/' + data + '">' + $('#todoTaskName').val() + '</a> <small class="float-end">Comments: <b>0</b></small></p>\
                                         <p><small>By <b>{{ Auth()->user()->name ?? 'Guest' }}</b> » ' + moment().format('D MMM YYYY, H:mm') + '</small> <small class="float-end right-0">Views: <b>0</b></small></p>\
                                    </div>\
                                </div');
                        $('#todoTaskName').val('');
                        $('#todoTaskDescription').val('');
                    },
                    error: function (data) {
                        console.log(data);
                        },
                    })
                });
            });
        </script>
    </body>
    </html>
@endsection
