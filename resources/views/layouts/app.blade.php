<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{asset('assets/images/favicion.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <title>@yield('title')</title>
  </head>
  <body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
                <a class="navbar-brand" href="{{url('/')}}"><img width="180" src="{{asset('assets/images/logo.png')}}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current()==route('HomePage')) active @endif" href="{{url('/')}}"><i class="fa fa-home"></i> Anasayfa</a>
                    </li>
                    <li class="nav-item @if(url()->current()==route('GetWords') && !request()->has('learned')) active @endif">
                      <a class="nav-link" href="{{url('words')}}"><i class="fa fa-database"></i> Kelimeler <span class="badge badge-secondary">{{$wordCount}}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(url()->current()==route('GetWords') && request()->has('learned') && request()->input('learned') == 1) active @endif" href="{{url('words?learned=1')}}"><i class="fa fa-check-circle"></i> Öğrendiklerim <span class="badge badge-success">{{$learnedWordCount}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('learn')}}"><i class="fa fa-play-circle"></i> Öğren</a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Yakında kullanıcı profili eklenecektir...">
                     <a class="nav-link text-light font-weight-bold" href=""><i class="fa fa-user"></i> {{$user->userName ." " . $user->userSurname}}</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="search" placeholder="Kelime ara" aria-label="Search">
                      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Ara</button>
                  </form>
                </div>
            </div>
      </nav>
    </header>

    @yield('content')

    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/kelime.js')}}"></script>
  </body>
</html>