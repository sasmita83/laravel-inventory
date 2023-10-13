
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" Aplikasi Inventory="">
    <meta name="author" content="sasmita">

    <title>login sasmita</title>

    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2/css/bootstrap.min.css')}}">
  </head>
  <body class="text-center">

<main class="form-signin w-25 m-auto">
  <form method="POST" action=" {{route('kirim-data-login')}}">
    @csrf
    <img class="mb-4" src="{{asset('image/SAS.jpg')}}" alt="" width="72" height="57">
    <br>{{$errors->first('email')}}
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022–2023</p>
  </form>
</main>
<script src="{{ asset ('bootstrap-5.3.2/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>
