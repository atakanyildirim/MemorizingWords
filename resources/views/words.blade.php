@extends('layouts.app')
@section('title', 'Kelimelerim | Kelime Ezberleme')
@section('content')
<main>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-10 mt-5">
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
                <h1 class="my-title">{{$heading}}</h1>
              </div>
              <div class="col-6 text-right">
                <a href="{{url('/')}}" class="text-decoration-none">
                  <button class="btn btn-dark btn-lg"><i class="fa fa-plus text-warning"></i> Yeni Kelime</button>
                </a>
              </div>
            </div>
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>İngilizce</th>
                      <th>Türkçe</th>
                      <th>Nitelik</th>
                      <th>Cümle</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($words as $word)
                    @if(request()->has('learned') && request()->input('learned') == 1)
                      @php
                        $word = \App\Model\Word::find($word->word_id);
                      @endphp
                    @endif
                      <tr>
                        <td>@if(request()->has('learned') && request()->input('learned') == 1)<i class="fa fa-check text-success"></i>@endif{{$word->eng}}</td>
                        <td>{{$word->tr}}</td>
                        <td>{{$word->attribute}}</td>
                        <td>{{$word->sentence}}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
        </div>
      </div> 
    </div>
  </main>
@endsection
