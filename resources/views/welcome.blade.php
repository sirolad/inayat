<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inayat Thrift</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

        <script type="text/javascript" src="{{ URL::to('js/app.js') }}" ></script>
        <script type="text/javascript" src="{{ URL::to('js/script.js') }}"></script>
        <script type="text/javascript" src="{{ URL::to('js/inayat.js') }}"></script>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title">
                    <b>Al-Inayat Multi-purpose Relief Investment </b>
                </div>

                <div class="row">
                <div class="col-md-12">
                  <section class="login-form">
                      @include('layout.alerts');
                    <form method="post" action="{{ route('login') }}" role="login">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="tel" name="phone" placeholder="Phone Number" required class="form-control input-lg" value="" />

                      <input type="password" class="form-control input-lg" id="password" placeholder="Password" name="password" required="" />
                      <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Log in</button>
                      <div>
                         <b><a href="{{ route('forgot') }}">Forgot password</a></b>
                      </div>

                    </form>
                  </section>
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
