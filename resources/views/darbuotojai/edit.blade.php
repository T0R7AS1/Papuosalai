@extends('layouts.app')

@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Keisti Suvenyro Informacija</h3></div>
                            <a href="{{ route('darbuotojai.index')}}" class="btn btn-primary"> Atgal</a>
                            <div class="card-body">
                                <form action="/darbuotojai/{{$darbuotojai->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="  mb-1" for="inputProjectname">Vardas</label>
                                        <input type="text" class="form-control" name="vardas" autocomplete="off" value="{{$darbuotojai->vardas}}">
                                    </div>
                                    <div class="form-group"> 
                                        <label class=" mb-1" for="inputProjectname">Telefonas</label>
                                        <input type="text" class="form-control" value="{{$darbuotojai->telefonas}}" name="telefonas" autocomplete="off">
                                    </div>
                                    <div class="form-group"> 
                                        <label class=" mb-1" for="inputProjectname">Apie</label>
                                        <textarea type="text" class="form-control" name="apie" autocomplete="off" rows="5">{{$darbuotojai->apie}}</textarea>
                                    </div>
                                    <label class=" mb-1" for="inputProjectname">Nuotrauka</label>
                                    <div class="form-group">
                                        <input type="file" name="image" class="mb-4">
                                        <img src="{{ URL::to('/') }}/storage/{{ $darbuotojai->image}}" width="100" alt="">
                                        <input type="hidden" name="hidden_image" value="{{$darbuotojai->image}}">
                                    </div>
                                    <input type="submit" class="btn btn-success btn-block mt-4 mb-2" name="add" value="Atnaujinti">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </main>
    </div>
</div>
@endsection