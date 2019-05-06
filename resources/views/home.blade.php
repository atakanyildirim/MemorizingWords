@extends('layouts.app')
@section('title', 'Anasyfa | Kelime Ezberleme')
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
            <h1 class="my-title">Yeni Kelime Ekleyin</h1>
            <form action="{{url('words')}}" method="POST">
              @csrf
                <div class="form-row mt-4">
                    <div class="form-group col-md-4">
                      <label for="eng">İngilizce <small class="text-info">*Zorunlu</small></label>
                    <input type="text" class="form-control form-control-lg input-high-height" name="eng" id="eng" value="{{old('eng')}}" placeholder="İngilizce">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="tr">Türkçe <small class="text-info">*Zorunlu</small></label>
                      <input type="text" class="form-control form-control-lg input-high-height" id="tr" name="tr" value="{{old('tr')}}" placeholder="Türkçe">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="attribute">Nitelik <small class="text-info">*Zorunlu</small></label>
                        <input type="text" class="form-control form-control-lg input-high-height" id="attribute" name="attribute" value="{{old('attribute')}}" placeholder="Niteliği">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="sentence">Cümle</label>
                        <input type="text" class="form-control form-control-lg input-high-height" id="sentence" value="{{old('sentence')}}" name="sentence" placeholder="Kelime ile ilgili bir cümle giriniz">
                    </div>
                    <div class="checkbox form-group pl-1">
                        <label style="font-size: 1.1em">
                            <input type="checkbox" name="learn" value="1">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            Öğrenmek istiyorum
                        </label>
                  </div>
                </div>
                  <button type="submit" class="btn btn-dark btn-lg">Kaydet</button>
            </form>
        </div>
      </div> 
    </div>
  </main>
@endsection
