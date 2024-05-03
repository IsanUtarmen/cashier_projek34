<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>| Log In | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('template') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('template') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('template') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('template') }}/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('template') }}/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="{{ route('cekLogin') }}" method="post" novalidate>
                        @csrf
                        <h1>Login Form</h1>
                        <div>
                            <input type="email"
                                class="form-control
                  @error('email')
                  is-invalid
                  @enderror
                  "
                                placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                        </div>
                        <div>
                            <input type="password"
                                class="form-control
                @error('password')
                  is-invalid
                @enderror
                "
                                placeholder="Password" name="password" value="{{ old('password') }}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Log in</button>
                            @error('password')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        @error('nofound')
                            <div class="row mb-2">
                                <div class="col-12 text-center text-danger">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        <div class="clearfix"></div>

                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and
                                    Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
