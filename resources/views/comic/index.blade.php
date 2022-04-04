{{-- Creo un file index che contenga tutti i fumetti --}}
@extends('layouts.base')

@section('pageTitle', 'Comics')

@section('content')

    <div class="container">

        <h1 class="my-4">Fumetti disponibili</h1>

        <a class="btn btn-success" role="button" href="{{route('comic.create')}}">Crea nuovo fumetto</a>

        <table class="table">

            <thead>

                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Serie</th>
                    <th scope="col">Data di vendita</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Link</th>
                </tr>

            </thead>

            <tbody>

                {{-- ciclo ogni fumetto presente in $data e lo mostro per ogni riga della tabella --}}
                @foreach ($data as $item)

                    <tr>
                        <th scope="row">{{$item['id']}}</th>
                        <td>{{$item['title']}}</td>
                        <td><p>{{$item['description']}}</p></td>
                        <td><img src="{{$item['thumb']}}" alt="{{$item['title']}}"></td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['series']}}</td>
                        <td>{{$item['sale_date']}}</td>
                        <td>{{$item['type']}}</td>
                        <td><a href="{{route('comic.show', $item->id)}}" class="btn btn-primary">Vedi</a></td>
                        <td><a href="{{route('comic.edit', $item->id)}}" class="btn btn-warning">Modifica</a></td>
                        <td><form method="POST" action="{{route('comic.destroy', ['comic' => $item->id])}}">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="btn btn-danger">Elimina</button>
                        </form></td>
                    </tr>
                    
                @endforeach
            
            </tbody>

        </table>

    </div>
    
@endsection