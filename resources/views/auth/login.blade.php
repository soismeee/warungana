
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login aplikasi </title>
    <link rel="icon" type="image/x-icon" href="/assets/src/assets/img/favicon.ico"/>
    <link href="/assets/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/assets/layouts/vertical-light-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/assets/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="/assets/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/assets/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    
    <link href="/assets/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/assets/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form action="/auth" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        
                                        <h2>Toko ana</h2>
                                        <p>Masuk untuk mengakses aplikasi</p>
                                    </div>
                                    @if (session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <strong>Error - </strong> {{ session('loginError') }}
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}">
                                            @error('username')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                            @error('password')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">MASUK</button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mb-4">
                                        <div class="">
                                            <div class="seperator">
                                                <hr>
                                                <div class="seperator-text"> <span>Toko ana</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>