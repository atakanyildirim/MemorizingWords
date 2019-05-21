@extends('layouts.app')
@section('title', 'İstatistik | Kelime Ezberleme')
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
            <h1 class="my-title">Öğrenme istatistiği</h1>
            <hr/>
            <div class="row">
              <div class="col-md-6">
                <canvas id="barChart"></canvas>
              </div>
              <div class="col-md-6">
              <form action="{{url('statistics')}}" method="GET">
                <div class="row form-group">
                  <div class="col-8">
                      <label for="month">Ay</label>
                      <select class="form-control" name="month" id="month">
                        <option @if(request()->has('month') && request()->input('month') == -1) selected @endif value="-1">Tüm Aylar</option>
                        <option @if(request()->has('month') && request()->input('month') == 1) selected @endif value="1">Ocak</option>
                        <option @if(request()->has('month') && request()->input('month') == 2) selected @endif value="2">Şubat</option>
                        <option @if(request()->has('month') && request()->input('month') == 3) selected @endif value="3">Mart</option>
                        <option @if(request()->has('month') && request()->input('month') == 4) selected @endif value="4">Nisan</option>
                        <option @if(request()->has('month') && request()->input('month') == 5) selected @endif value="5">Mayıs</option>
                        <option @if(request()->has('month') && request()->input('month') == 6) selected @endif value="6">Haziran</option>
                        <option @if(request()->has('month') && request()->input('month') == 7) selected @endif value="7">Temmuz</option>
                        <option @if(request()->has('month') && request()->input('month') == 8) selected @endif value="8">Ağustos</option>
                        <option @if(request()->has('month') && request()->input('month') == 9) selected @endif value="9">Eylül</option>
                        <option @if(request()->has('month') && request()->input('month') == 10) selected @endif value="10">Ekim</option>
                        <option @if(request()->has('month') && request()->input('month') == 11) selected @endif value="11">Kasım</option>
                        <option @if(request()->has('month') && request()->input('month') == 12) selected @endif value="12">Aralık</option>
                      </select>
                  </div>
                  <div class="col-4">
                      <label for="year">Yıl</label>
                      <select class="form-control" name="year" id="year">
                        @for ($i = date("Y"); $i >= 2000; $i--)
                        <option @if(request()->has('year') && request()->input('year') == $i) selected @endif value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <button class="btn btn-warning btn-lg" type="submit">Getir</button>
              </div>
              </form>
              </div>
            </div>
        </div>
      </div> 
    </div>
  </main>
@endsection
@section('javascript')
<script>
  var ctxB = document.getElementById("barChart").getContext('2d');
  var myBarChart = new Chart(ctxB, {
    type: 'bar',
    data: {
      labels: ["Öğrenilmeye Devam Eden Kelimeler", "Öğrenilen Kelimeler"],
      datasets: [{
        label: 'Kelime Ezberleme',
        data: [{{$numberOfLearnedWord}}, {{$numberOfUnLearnedWord}}],
        backgroundColor: [
          'rgba(251, 255, 0, 0.2)',
          'rgba(54, 162, 235, 0.2)',
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize:1,
          }
        }]
      }
    }
  });
</script>
@endsection
