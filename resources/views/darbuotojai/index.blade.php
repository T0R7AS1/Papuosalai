@extends('layouts.app')


@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Visi Darbuotojai
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Vardas</th>
                            <th>Telefonas</th>
                            <th width="300">Veiksmai</th>
                        </tr>
                    </thead>
                    @foreach ($darbuotojai as $darbuotojas)
                        <tr>
                            <td width="10%"><img src="{{ URL::to('/') }}/storage/{{ $darbuotojas->image }}" width="75" class="mx-auto d-block" alt=""></td>
                            <td >{{ $darbuotojas->vardas }}</td>
                            <td>{{ $darbuotojas->telefonas }}</td>
                            <td>
                                <a href="/darbuotojai/{{$darbuotojas->id}}" class="btn btn-info">Placiau</a>
                                <a href="/darbuotojai/{{$darbuotojas->id}}/edit" class="btn btn-warning d-inline ">Keisti</a>
                                <form action="{{action('App\Http\Controllers\DarbuotojaiController@destroy', $darbuotojas['id'])}}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn-danger btn btn-xs">Naikinti</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $darbuotojai->links() }}
            </div>
        </div>
    </div>
@endsection