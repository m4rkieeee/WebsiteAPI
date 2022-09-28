@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <img src="{{ asset('img/login.jpg') }}" id="bgimage" style=" position: absolute; background: linear-gradient(black, white)">
    <nav>
        <div class="nav-wrapper blue">

            <div class="container">
                <a href="{{ url('./home') }}" class="brand-logo">Fased</a>
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
            <li class="active"><a href=" {{ url('./home') }}" class="white-text"><i class="material-icons white-text">home</i>Home</a></li>
            <li><a href="#" data-target="modalPost" class="modal-trigger white-text"><i class="material-icons white-text">group</i>New Post</a></li>
            <li><a href="{{ url('./signout') }}" class="white-text"><i class="material-icons white-text">logout</i>Sign Out</a></li>

        </ul>
    </div>

    <div class="row">
        <div id="postRows">
            @foreach($todo as $todos)
                <div class="col s12 m6 l4">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">{{ $todos->taskName }}</span>
                            <span class="card-content"><b>{{ $todos->taskDescription }}</b></span>
                            <br />
                            <br />
                            <span class="card-content">Starting: {{ $todos->startdate->format('d F Y') }}</span>
                            <br />
                            <span class="card-content">Ending: {{ $todos->enddate->format('d F Y') }}</span>
                            @if(auth()->user()->id === $todos->user_id && $todos->done === 0)
                                <button type="button" class="btn-small right">Done?</button>
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
$(document).ready(function() {
$('#modalPost').modal();
$('#todoStartDate').datepicker();
$('#todoEndDate').datepicker();

$(document).on('click', '#addPost', function(e) {
console.log($('#todoTaskName').val());
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
console.log(data);
$('#modalPost').modal('close');
$('#postRows').append(
'<div class="col s12 m6 l4"> \
<div class="card white"> \
<div class="card-content">\
<span class="card-title">' + data['taskName'] + '</span>\
<span class="card-content"><b>' + data['taskDescription'] + '</b></span>\
<br />\
<br />\
<span class="card-content">Starting: ' + moment(data['startdate']).format('D MMMM YYYY h:mm') + '</span>\
<br />\
<span class="card-content">Ending: ' + moment(data['enddate']).format('D MMMM YYYY h:mm') + '</span>\
<button type="button" class="btn-small right">Done?</button>\
</div>\
</div>\
</div>');
$('#todoTaskName').val('');
$('#todoTaskDescription').val('');
$('#todoStartDate').datepicker({
i18n: {
months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"]
}
});
$('#todoEndDate').datepicker('clear');
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
