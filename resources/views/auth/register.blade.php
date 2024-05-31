@extends('layouts.app')

@section('content')
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style1.css">
    </head>

    <body>



        <!-- Sign up form -->
        <section class="signup" style="margin-bottom: 0">
            <div class="container" style="font-family:verdana;">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 style="font-family:verdana" class="form-title">Register</h2>
                        <form method="POST" action="/register" class="register-form">
                            @csrf
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input style="font-family:verdana" type="text" id="name" placeholder="Your Name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div style ="line-height: 180% ">
                                <br>
                            </div>
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input style="font-family:verdana" type="email" id="email" placeholder="Your Email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group" style="margin-bottom: 0">
                                <label for="password" class="col-md-4 col-form-label text-md-end"></label>

                                    <input style="font-family:verdana;" id="password" type="password"
                                        placeholder= "Password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                            </div>


                            <div class="form-group" >
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end"></label>


                                    <input style="font-family:verdana;" id="password-confirm" type="password"
                                        placeholder= "Password Confirmation" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">

                            </div>


                            <div class="form-group form-button">
                                <button type="submit"  class="btn btn-l btn-primary" style="border: black; padding: 10px 20px 10px 20px;">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="img/signup2.png" alt="sign up image"></figure>
                        <a href="/login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        </div>

        <!-- JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/main.js"></script>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

    </html>
    @endsection
