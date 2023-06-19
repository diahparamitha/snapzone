<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <title>Form Login</title>
  </head>
  <body>

    <form method="post" action="/login">
      @csrf
        @if(session()->has('login')) 
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('login') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close"></button>
          </div>
      @endif
      
        <h2>Login</h2>
        <label for="email"> Email </label><br>
        <input type="email" id="email" name="email" placeholder="Enter email"><br>
        <label for="password"> Password </label><br>
        <input type="password" id="password" name="password" placeholder="Enter password"><br>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
        <p style="text-align: center;"> Belum punya akun? Daftar <a href="/user/create">disini!</a></p>
    </form>
    
  </body>
</html>
