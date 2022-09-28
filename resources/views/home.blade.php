@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <img src="{{ asset('img/login.jpg') }}" id="bgimage">
    <nav>
        <div class="nav-wrapper blue">

            <div class="container">
                <a href="{{ url('./home') }}" class="brand-logo">Portal</a>
                <a href="#" class="sidenav-trigger" data-target="slide_out"><i class="material-icons">menu</i></a>
                <ul class="hide-on-med-and-down right" id="navSelector">
                    <li class="active"><a href="{{ url('./home') }}">Home</a></li>
                    <li><a data-target="modalPost" class="modal-trigger">New Post</a></li>
                    <li><a href="{{ url('./signout') }}">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="nav-wrapper">
        <ul class="sidenav blue" id="slide_out" style="height: 25%;">
            <li class="active"><a href=" {{ url('./home') }}" class="white-text"><i class="material-icons white-text">home</i>Home</a>
            </li>
            <li><a href="#" data-target="modalPost" class="modal-trigger white-text"><i
                        class="material-icons white-text">group</i>New Post</a></li>
            <li><a href="{{ url('./signout') }}" class="white-text"><i class="material-icons white-text">logout</i>Sign
                    Out</a></li>

        </ul>
    </div>

    <div class="row">
        <div id="postRows">
            @foreach($todo as $todos)
                <div class="col s12 m6 l4">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">{{ $todos->taskName }}</span>
                            <span class="card-title right"><button class="material-icons amber-text btn-floating white">mode</button> <button id="{{ $todos->id }}" name="deleteTodo" class="material-icons red-text btn-floating white">close</button></span>
                            <span class="card-content"><b>{{ $todos->taskDescription }}</b></span>
                            <br/>
                            <br>
                            <hr>
                            <span class="card-content"><b>Starting:</b> {{ $todos->startdate->format('d F Y')}}</span>
                            <br/>
                            <span class="card-content"><b>Ending:</b> {{ $todos->enddate->format('d F Y')}}</span>
                            <br />
                            <span class="card-content"><b>Posted by: </b>{{$todos->user->name ?? 'No cards here'}}</span>
                            @if(auth()->user()->id === $todos->user_id && $todos->done === 0)
                                <button type="button" class="btn-small right blue" id="{{ $todos->id }}" name="finishTodo">Done?</button>
                            @elseif($todos->done === 0)
                                <a class="amber-text right"><b>In Progress!</b></a>
                            @else
                                <a class="green-text right"><b>Finished!</b></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if(Auth()->check())
        <!-- Modal Structure -->
        <div id="modalPost" class="modal">
            <div class="modal-content">
                <h4>Add Post</h4>
                <input type="hidden" id="type" value="addPost">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="todoTaskName" class="materialize-textarea"></textarea>
                    <label for="todoTaskName">Task Name</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">comment</i>
                    <textarea id="todoTaskDescription" class="materialize-textarea"></textarea>
                    <label for="todoTaskDescription">Task Description</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="datepicker" id="todoStartDate">
                    <label for="todoStartDate">Start Date</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="datepicker" id="todoEndDate">
                    <label for="todoEndDate">End Date</label>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="modal-close waves-effect waves-green btn-flat">Close</a>
                <a href="#" class="waves-effect waves-green btn-flat" id="addPost">Add Post</a>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#modalPost').modal();
            $('#todoStartDate').datepicker();
            $('#todoEndDate').datepicker();

            $(document).on('click', 'button[name=finishTodo]', function (e) {
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('todo.actions') }}",
                    type: 'POST',
                    data: {
                        type: 'finishTodo',
                        todoID: id,
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    },
                })
            });

            $(document).on('click', 'button[name=deleteTodo]', function (e) {
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('todo.actions') }}",
                    type: 'POST',
                    method: 'DELETE',
                    data: {
                        type: 'deleteCard',
                        todoID: id,
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    },
                })
            });

            $(document).on('click', '#addPost', function (e) {
                $.ajax({
                    url: "{{ route('todo.actions') }}",
                    type: 'POST',
                    data: {
                        type: 'addPost',
                        taskName: $('#todoTaskName').val(),
                        taskDescription: $('#todoTaskDescription').val(),
                        startDate: $('#todoStartDate').val(),
                        endDate: $('#todoEndDate').val(),
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $('#modalPost').modal('close');
                        $('#postRows').append(
                            '<div class="col s12 m6 l4"> \
                                <div class="card white"> \
                                    <div class="card-content">\
                                        <span class="card-title">' + data['taskName'] + '</span>\
                                        <span class="card-content"><b>' + data['taskDescription'] + '</b></span>\
                                        <br />\
                                        <hr />\
                                        <br>\
                                        <span class="card-content">Starting: ' + moment(data['startdate']).format('D MMMM YYYY h:mm') + '</span>\
                                        <br />\
                                        <span class="card-content">Ending: ' + moment(data['enddate']).format('D MMMM YYYY h:mm') + '</span>\
                                        <br />\
                                                                    <span class="card-content"><b>Posted by: </b>{{$todos->user->name?? ''}}</span>\
                                        <button type="button" class="btn-small right blue">Done?</button>\
                                    </div>\
                                </div>\
                            </div>'
                        );

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
    <script>
        const slide_menu = document.querySelectorAll(".sidenav");
        M.Sidenav.init(slide_menu, {});
    </script>
@endsection
