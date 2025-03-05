<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="row text-center justify-content-center">
            <h1 class="font-weight-bold">{{ config('app.name') }}</h1>
        </div>
        <div class="row text-center justify-content-center mb-2">
            <h2>{{ $title }} - Aura</h2>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login to continue</p>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div class="row align-items-center">
                            <i class="fas fa-check mr-2"></i> {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('authError'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <div class="row align-items-center">
                            <i class="fas fa-ban mr-2"></i> {{ session('authError') }}
                        </div>
                    </div>
                @endif
                <form action="{{ route('auth.authenticate') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback mb-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" id="password" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback mb-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a href="{{ route('auth.register') }}" class="btn btn-secondary btn-block">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
