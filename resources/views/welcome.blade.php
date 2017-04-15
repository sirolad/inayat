<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inayat Thrift</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script type="text/javascript" src="js/app.js" ></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title">
                    <b>Al-Inayat Credit & Thrift Society</b>
                </div>

                <div class="row">
                <div class="col-md-12">
                  <section class="login-form">
                    <form method="post" action="#" role="login">
                      <input type="phone" name="phone" placeholder="Phone Number" required class="form-control input-lg" value="" />

                      <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />


                      <div class="pwstrength_viewport_progress"></div>


                      <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
                      <div>
                         <a href="#">Reset password</a>
                      </div>

                    </form>
                  </section>
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
