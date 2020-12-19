@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center container">
        <div id="invoice">
        <p class="h5" ><b>vardas</b> <br> {{$darbuotojai->vardas}}</p>
        <p class="h5" ><b>telefonas</b> <br> {{$darbuotojai->telefonas}}</p>
        <p class="h5" ><b>Apie</b> <br> {{$darbuotojai->apie}}</p>
        <p class="h5" ><b>Nuotrauka</b> <center><img src="{{ URL::to('/') }}/storage/{{ $darbuotojai->image }}" width="10%" alt=""></center></p>
        <br>
        <hr>
        </div>
    <a href="/darbuotojai/{{$darbuotojai->id}}/edit" class="btn btn-warning mt-3">Keisti</a>
    <form action="{{action('App\Http\Controllers\DarbuotojaiController@destroy', $darbuotojai['id'])}}" method="POST" class="d-inline ">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn-danger btn mt-3">Naikinti</button>
    <a href="{{ route('darbuotojai.index')}}" class="btn btn-primary mt-3">Atgal</a>
    </form>
    </div>
@endsection