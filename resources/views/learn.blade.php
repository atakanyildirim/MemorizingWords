@extends('layouts.app')
@section('title', 'Kelime Sınama | Kelime Ezberleme')
@section('content')
<main>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-12 mt-5">
          <div class="row">
              <div class="col-12">
                <h1 class="my-title">Kelime Sınama</h1><hr/>
              </div>
          </div>
          @if(session('message'))
          <div class="alert alert-danger border-dark alert-dismissible fade show">
            <h2 class="my-title">Uyarı!</h2>
            {{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          @if(session('testResult'))
              <h4 class="my-title">Test Sonuçları</h4>
              <ul class="list-group">
              @foreach (session('testResult') as $result)
                <li class="list-group-item"><b>Soru</b>: {{$result['ask']}}<br/> <b>Verilen cevap</b>: {{$result['answer']}} <br/> @if(!$result['correct']) <b>Doğru cevap:</b> {{$result['rightAnswer']}}<br/><span class="badge badge-danger">Yanlış</span> @else <span class="badge badge-success">Doğru</span>@endif</li>
              @endforeach
              </ul>
          @endif

            @if(!count($stageOne) && !count($stageTwo) && !count($stageThree) && !count($stageFour))
              <div class="alert alert-warning mt-2"><h3 class="my-title">Uyarı!</h3>Sınama zamanı gelen bir kelime yok</div>
            @else
          <form action="{{url('learn')}}" method="POST">
            @csrf
            @foreach ($stageOne as $stage)
              @php
                $wordDetail = \App\Model\Word::find($stage->word_id);
                $randomWords = \App\Model\Word::where('id', '!=' , $stage->word_id)->inRandomOrder()->distinct()->take(3)->get(['tr'])->toArray();
                array_push($randomWords,['tr' => $wordDetail->tr]);
                shuffle($randomWords);
              @endphp
              <h4><span class="badge badge-primary">{{$wordDetail->eng}}</span> kelimesinin türkçe karşılığı hangisidir?</h4>
              @foreach($randomWords as $randomWord)
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="{{$stage->id}}_{{$randomWord['tr']}}" name="{{$stage->id}}" value="{{$randomWord['tr']}}" class="custom-control-input">
                  <label class="custom-control-label" for="{{$stage->id}}_{{$randomWord['tr']}}">{{$randomWord['tr']}}</label>
                </div>
              @endforeach
              <hr>
            @endforeach

            @foreach ($stageTwo as $stage)
            @php
              $wordDetail = \App\Model\Word::find($stage->word_id);
              $randomWords = \App\Model\Word::where('id', '!=' , $stage->word_id)->inRandomOrder()->distinct()->take(3)->get(['tr'])->toArray();
              array_push($randomWords,['tr' => $wordDetail->tr]);
              shuffle($randomWords);
            @endphp
            <h4><span class="badge badge-primary">{{$wordDetail->eng}}</span> kelimesinin türkçe karşılığı hangisidir?</h4>
            @foreach($randomWords as $randomWord)
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="{{$stage->id}}_{{$randomWord['tr']}}" name="{{$stage->id}}" value="{{$randomWord['tr']}}" class="custom-control-input">
                <label class="custom-control-label" for="{{$stage->id}}_{{$randomWord['tr']}}">{{$randomWord['tr']}}</label>
              </div>
            @endforeach
            <hr>
          @endforeach

          @foreach ($stageThree as $stage)
          @php
            $wordDetail = \App\Model\Word::find($stage->word_id);
            $randomWords = \App\Model\Word::where('id', '!=' , $stage->word_id)->inRandomOrder()->distinct()->take(3)->get(['tr'])->toArray();
            array_push($randomWords,['tr' => $wordDetail->tr]);
            shuffle($randomWords);
          @endphp
          <h4><span class="badge badge-primary">{{$wordDetail->eng}}</span> kelimesinin türkçe karşılığı hangisidir?</h4>
          @foreach($randomWords as $randomWord)
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="{{$stage->id}}_{{$randomWord['tr']}}" name="{{$stage->id}}" value="{{$randomWord['tr']}}" class="custom-control-input">
              <label class="custom-control-label" for="{{$stage->id}}_{{$randomWord['tr']}}">{{$randomWord['tr']}}</label>
            </div>
          @endforeach
          <hr>
        @endforeach
        @foreach ($stageFour as $stage)
          @php
            $wordDetail = \App\Model\Word::find($stage->word_id);
            $randomWords = \App\Model\Word::where('id', '!=' , $stage->word_id)->inRandomOrder()->distinct()->take(3)->get(['tr'])->toArray();
            array_push($randomWords,['tr' => $wordDetail->tr]);
            shuffle($randomWords);
          @endphp
          <h4><span class="badge badge-primary">{{$wordDetail->eng}}</span> kelimesinin türkçe karşılığı hangisidir?</h4>
          @foreach($randomWords as $randomWord)
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="{{$stage->id}}_{{$randomWord['tr']}}" name="{{$stage->id}}" value="{{$randomWord['tr']}}" class="custom-control-input">
              <label class="custom-control-label" for="{{$stage->id}}_{{$randomWord['tr']}}">{{$randomWord['tr']}}</label>
            </div>
          @endforeach
          <hr>
        @endforeach
        <button class="btn btn-dark btn-lg" type="submit">Bitir</button>
        </form>
        @endif
        </div>
      </div> 
    </div>
  </main>
@endsection
