@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section class="container-fluid">
    @can('create', App\Tag::class)
        <a class="btn btn-secondary" href="{{ route('tag.create') }}">Crear etiqueta</a>
    @endcan
    <form class="mt-4 mb-2" action="{{ route('tag.filter') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col col-md-2">
                <label class="mr-sm-2 sr-only" for="filtrar">filtrar</label>
                <select class="custom-select mr-sm-2" name="filterParameter" id="filtrar">
                    <option selected="selected" value="name">Nombre</option>
                </select>
            </div>
            <div class="col col-md-5"><input value="{{ old('name') }}" name='name'
                    class="form-control" type="text"></div>
            <div class="col col-md-2"><button class="btn btn-primary" type="submit">Buscar</button></div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Etiquetas
            </h4>
        </div>
        <div class="table-responsive mt-4 mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Numero de entradas</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td> <a
                                    href="{{ env('APP_HOST_FRONT').':'.env('APP_HOST_FRON_PORT').'/tags/'.$tag->id }}">
                                    {{ $tag->name }}</a> </td>
                            <td> {{ $tag->posts_count }} </td>
                            @can('update', $tag)
                                <td>
                                    <a href="{{ route('tag.edit', $tag->id) }}"
                                        class="btn btn-sml btn-secondary"> Editar</a>
                                </td>
                            @endcan
                            @can('delete', $tag)
                                <td>
                                    <form action="{{ route('tag.destroy', $tag->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sml btn-danger"
                                            onClick="return confirm('Estas seguro de querrer eliminarlo?')"><i
                                                class="fa fa-timex"></i> Borrar</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <nav class="d-flex justify-content-end">
        {{ $tags->links() }}
    </nav>
</section>

@endsection
