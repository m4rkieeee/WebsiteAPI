@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <html>
    <head>
        <title>Login</title>
        <!--Import Google Icon Font-->

        <style>
            html {
                font-family: Fantasy;
            }
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
                z-index: 10;
            }

            body {
                background: #ffffff;
            }

            .input-field input[type=text]:focus + label,
            .input-field input[type=password]:focus + label {
                color: #1E88E5;
            }

            .input-field input[type=text]:focus,
            .input-field input[type=password]:focus {
                border-bottom: 1px solid #1E88E5;
                box-shadow: none;
            }

            #bgimage {
                height: 100%;
                width: 100%;
                mask-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 50%);
                z-index: 0;
            }
        </style>
    </head>

    <body>
    <img src="{{ asset('img/login.jpg') }}" id="bgimage" style="position: absolute; background: linear-gradient(black, white)">
    <div class="section" style="z-index: 10;">
        <main>
            <div style="text-align: center;">
                <img src="{{asset ('img/logoipsum.png')}}" class="responsive-img" style="width: 250px;"/>
                <div class="section">
                    <div class="section"></div>
                    <div class="container">
                        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0 48px;background-color: white; border: 1px solid #000000;">
                            <form role="form" class="col s12" method="POST" action="{{ route('login.custom') }}">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="tiny material-icons prefix">account_circle</i>
                                        <input class="validate" type="text" name="name" id="name">
                                        <label for="name" class="">Username</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="text-danger mb-3">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="input-field col s12">
                                        <i class="tiny material-icons prefix">vpn_key</i>
                                        <input class="validate" type="password" name="password" id="password" @if ($errors->has('password')) is-invalid @elseif(session()->has('invalidPassword')) is-invalid @endif />
                                        <label for="password" class="">Password
                                        </label>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    @if(session()->has('invalidPassword'))
                                        <span class="text-danger">{{ session()->get('invalidPassword') }}</span>
                                    @endif
                                    <label style="float: right">
                                        <a class="red-text" href="#!"><b>Forgot Password?</b></a>
                                    </label>
                                </div>
                                <br />
                                <center>
                                    <div class="row">
                                        <button type="submit" name="btnLogin" class="col s12 btn btn-large waves-effect indigo">Login</button>
                                    </div>
                                    <div class="row">
                                        <a href="../register/index.html">Register</a>
                                    </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="{{ asset('js/materialize.js') }}"></script>
    </body>
    </html>
@endsection
