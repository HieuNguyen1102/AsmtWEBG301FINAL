<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> | Registration Page</title>

  <style>
    .login-box {
      text-align: center;
    }

    .register-logo img {
      max-width: 250px; /* Adjust the size as needed */
      margin: 0 auto; /* Center the image horizontally */
      display: block;
    }
  </style>
 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
<div class="register-logo">
        <img src="../../assets/img/welcome2Ebay.jpeg" alt="Welcome2Ebay Logo">
    </div>
 
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      @if(session('error'))
              <div class="alert alert-danger text-light text-center m-2" role="alert">
                {{ session('error') }}
              </div>
            @endif
        <form action="{{ route('register.store') }}" method="POST" role="form text-left">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full name" required>
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
         
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="User name" required>
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
 
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
          <!-- /.col -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
 
 
      <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
 
<!-- jQuery -->
<script src="../assets/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>