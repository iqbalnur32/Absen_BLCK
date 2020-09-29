<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://indosec.id/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('template/dist/css/v_login.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700|Montserrat:300,400,500,700&display=swap" rel="stylesheet">
</head>
<body class="text-center">
    <div class="container mt-5 mx-auto h-100vh">
        <div class="row align-items-center justify-content-center">
            <div class="col w-320px">
                <form method="post" action="{{ route('loginProcess') }}">
                    @if (session('gagal'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('gagal') }}</strong>
                    </div>
                    @elseif(session('sukses'))
                    <div class="alert alert-primary alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ session('sukses') }}</strong>
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    @csrf
                    <div class="buttom" style="padding-bottom:70px;">
                        
                    </div>
                    <h1 class="h3 text-dark merriweather font-weight-bold mt-4 pt-1">Login Akun</h1><br>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Emil Atau Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>