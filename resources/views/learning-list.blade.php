@extends('layouts.app')
@section('title', 'Öğrenme Listesi | Kelime Ezberleme')
@section('content')
<main>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-12 mt-5">
          @if(session('message'))
            <div class="alert alert-{{session('color')}} border-dark alert-dismissible fade show">
              <h4 class="my-title">{{session('title')}}</h4>
              {{session('message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
            @if ($errors->any())
              <div class="alert alert-warning border-dark alert-dismissible fade show">
                <h4 class="my-title">Dikkat!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>* {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="row">
              <div class="col-6">
                <h1 class="my-title">Öğrenme Listesi</h1>
              </div>
              <div class="col-6 text-right">
                <a href="{{url('/')}}" class="text-decoration-none">
                  <button class="btn btn-dark btn-lg"><i class="fa fa-plus text-warning"></i> Yeni Kelime</button>
                </a>
              </div>
            </div>
             <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>İngilizce</th>
                      <th>Türkçe</th>
                      <th>Öğrenme Aşaması (1-4)</th>
                      <th>Durum</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($learningList as $list)
                    @php
                        $word = \App\Model\Word::find($list->word_id);
                    @endphp
                      <tr>
                        <td>@if($word->learned == 1)<i class="fa fa-check-circle text-success" title="Öğrenildi"></i>@endif {{$word->eng}}</td>
                        <td>{{$word->tr}}</td>
                        <td>@for($i = 0; $i < $list->stage -1; $i++)<i class="fa fa-star text-warning fa-2x"></i> @endfor @if($list->stage == 4 && $word->learned == 1)<i class="fa fa-star text-warning fa-2x"></i>@endif</td>
                        <td>@if($list->completed == 0) <span class="badge badge-dark">Devam Ediyor</span> @else <span class="badge badge-success">Tamamlandı</span> @endif</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              @if(!count($learningList))
                <div class="alert alert-warning">Henüz öğrenme listesine bir kelime eklenmemiş.</div>
              @endif
              {{ $learningList->appends(request()->except('page'))->links() }}
        </div>
      </div> 
    </div>
  </main>
@endsection
