@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')
<section class="container-fluid">
    @can('create', App\Post::class)
    <a class="btn btn-secondary" href="{{ route('post.create') }}">Crear entrada</a>
    @endcan
    <form class="mt-4 mb-2" action="{{ route('post.filter') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col col-md-2 col-lg-1">
                <label class="mr-sm-2 sr-only" for="filtrar">filtrar</label>
                <select class="custom-select mr-sm-2" name="filterParameter" id="filtrar">
                    <option selected="selected" value="category">Categoria</option>
                    <option value="tag">Etiqueta</option>
                </select>
            </div>
            <div class="col col-md-5"><input class="form-control" value="{{ old('name') }}"
                    name='name' type="text"></div>
            <div class="col col-md-2"><button class="btn btn-primary" type="submit">Filtrar</button></div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Entradas
            </h4>
        </div>
    <div class="table-responsive mt-4 mb-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Categoria</th>
                    <th>Etiquetas</th>
                    <th>Destacado</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><a
                                href="{{ env('APP_HOST_FRONT').':'.env('APP_HOST_FRON_PORT').'/posts/'.$post->id }}">
                                {{ Str::limit( $post->title,50) }} </a> </td>
                        <td> {{ $post->category->name }}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($post->featured==true) si @else no @endif
                        </td>
                        <td>
                            <form action="{{ route('post.changeStatus', $post->id) }}"
                                method="post">
                                @csrf
                                @if(Str::of($post->status)->exactly('publiced'))
                                    <div>Publicado</div>
                                    <input type="hidden" name="status" value="draff">
                                    <button type="submit"
                                        class="btn btn-sm btn-info">cambiar a borrador</button>
                                @else
                                    <div>Borrador</div>
                                    <input type="hidden" name="status" value="publiced">
                                    <button type="submit"  class="btn btn-sm btn-info">
                                        publicar</button>
                                @endif
                            </form>
                        </td>
                        @can('update', $post)
                        <td>
                            <a href="{{ route('post.edit', $post->id) }}"
                                class="btn btn-sml btn-secondary"> Editar</a>

                        </td>
                        @endcan
                        @can('delete', $post)
                        <td>
                            <form action="{{ route('post.destroy', $post->id) }}"
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
        {{ $posts->links() }}
    </nav>
</section>
@endsection
