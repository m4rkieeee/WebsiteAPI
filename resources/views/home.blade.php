@extends('layouts.app')

@section('content')
    <head>
        <title>Register</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


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
            }
        </style>
    </head>

    <body>
    <img src="./img/login.jpg" id="bgimage" style="z-index: 1; position: absolute; background: linear-gradient(black, white)">
    <div class="section" style="z-index: 10;">
        <main>
            <div style="text-align: center;">
                <img src="./img/logoipsum.png" class="responsive-img" style="width: 250px;"/>
                <div class="section">
                    <div class="section"></div>
                    <div class="container">
                        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; width: 36.3%; padding: 32px 48px 0px 48px; border: 1px solid #000000">
                            <form class="col s12" method="post">
                                <div class="row">
                                    <div class="col s12">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="tiny material-icons prefix">account_circle</i>
                                        <input class="validate" type="text" name="username" id="username">
                                        <label for="username" class="">Username</label>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="input-field col s12">
                                        <i class="tiny material-icons prefix">vpn_key</i>
                                        <input class="validate" type="password" name="password" id="password" />
                                        <label for="password" class="">Password
                                        </label>
                                    </div>
                                    <label style="float: right">
                                        <br />
                                    </label>
                                </div>
                                <br />
                                <center>
                                    <div class="row">
                                        <button type="submit" name="btnRegister" class="col s12 btn btn-large waves-effect indigo">Register</button>
                                    </div>
                                    <div class="row">
                                        <a href="../login/index.html">Login</a>
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
    <script type="text/javascript" src="js/materialize.js"></script>
    </body>
    </html>

@endsection
