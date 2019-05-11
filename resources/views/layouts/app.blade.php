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
                    <li class="nav-item @if(url()->current()==route('Words') && !request()->has('learned')) active @endif">
                      <a class="nav-link" href="{{url('words')}}"><i class="fa fa-database"></i> Kelimeler <span class="badge badge-secondary">{{$wordCount}}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(url()->current()==route('LearningList')) active @endif" href="{{url('learning-list')}}"><i class="fa fa-th-list"></i> Öğrenme Listesi <span class="badge badge-success">{{$learningListCount}}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(url()->current()==route('Learn')) active @endif" href="{{url('learn')}}"><i class="fa fa-play-circle"></i> Kelime Testi</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link @if(url()->current()==route('Statistics')) active @endif" href="{{url('statistics')}}"><i class="fa fa-bar-chart"></i> İstatistik</a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Yakında kullanıcı profili eklenecektir...">
                     <a class="nav-link" href=""><i class="fa fa-user"></i> {{$user->userName ." " . $user->userSurname}}</a>
                    </li>
                  </ul>
                </div>
            </div>
      </nav>
    </header>

    @yield('content')

    <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script src="{{asset('assets/js/kelime.js')}}"></script>
    @yield('javascript')
  </body>
</html>