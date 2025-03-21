<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MM | Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="vendor/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container pt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5 pt-5">

            <div class="col-lg-8">


                {{--  <div class="col-xl-10 col-lg-12 col-md-9"> --}}

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg d-none d-lg-block text-center">
                                <img src="img/besi-tua.png" class="img-fluid" style="height: 100%; width:100%;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">SI Pencatatan Besi Tua</h1>
                                    </div>

                                    <form action="/login" method="POST">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username"
                                                class="form-control form-control-user @error('username') is-invalid @enderror"
                                                id="username" aria-describedby="username" placeholder="username"
                                                required>
                                        </div>

                                        {{-- @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif --}}
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" aria-describedby="password" id="password"
                                                placeholder="Password" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
