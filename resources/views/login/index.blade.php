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

    <style>
        * {
  margin: 0;
  padding: 0;
}

.carousel-container {
  height: 100%; /* Set container height */
  overflow: hidden; /* Prevent overflow */
}

.carousel-container {
  width: 100%;         /* Full width of its parent */
  height: 100%;       /* Or any fixed height you prefer */
  overflow: hidden;    /* Hide overflowing content */
  position: relative;  /* Relative positioning for flexibility */
}

.carousel_items {
  display: flex;        /* Line items in a row */
  transition: transform 0.5s linear;
  height: 100%;         /* Match parent height */
}

.carousel_item {
  min-width: 100%;      /* Full width */
  height: 100%;         /* Match container height */
  background-repeat: no-repeat;
  background-size: cover;     /* Make sure the image covers the entire container */
  background-position: center; /* Center the image */
  transition: transform 0.5s ease-in-out;
}

.item1 {
  background-image: url("img/login1.jpg");
}
.item2 {
    background-image: url("img/login2.jpg");
}
.item3 {
  background-image: url("img/login3.jpg");
}

    </style>

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
                            <div class="carousel-container">
  <div class="carousel_items">
    <div class="carousel_item item1">
    </div>
    <div class="carousel_item item2">
    </div>
    <div class="carousel_item item3">
    </div>
  </div>
</div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <div class="d-flex mb-2 align-items-center justify-content-center">
                                        <h5 class="h5 text-gray-900 ">SI Pencatatan Besi Tua</h5>
          
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

    <script>
        const carouselItems = document.querySelectorAll(".carousel_item"); 
let i = 1;

setInterval(() => {
// Accessing All the carousel Items
 Array.from(carouselItems).forEach((item,index) => {

   if(i < carouselItems.length){
    item.style.transform = `translateX(-${i*100}%)`
   }
  })


  if(i < carouselItems.length){
    i++;
  }
  else{
    i=0;
  }
},2000)
    </script>

</body>

</html>
