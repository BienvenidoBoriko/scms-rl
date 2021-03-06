@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section class="container-fluid">
    @can('create', App\Category::class)
        <a class="btn btn-secondary" href="{{ route('category.create') }}">crear categoria</a>
    @endcan
    <form class="mt-4 mb-2" action="{{ route('category.filter') }}" method="POST"
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
                Categorias
            </h4>
        </div>
        <div class="table-responsive mt-4 mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Numero de entradas</th>
                        <th>Es Visible</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><a
                                    href="{{ env('APP_HOST_FRONT').':'.env('APP_HOST_FRON_PORT').'/categories/'.$category->id }}">
                                    {{ $category->name }} </a></td>
                            <td>{{ $category->posts_count }}</td>
                            <td> {{ $category->visibility }} </td>
                            @can('update', $category)
                                <td>

                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-sml btn-secondary"> Editar</a>

                                </td>
                            @endcan
                            @can('delete', $category)
                                <td>
                                    <form
                                        action="{{ route('category.destroy', $category->id) }}"
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
        {{ $categories->links() }}
    </nav>
</section>
@endsection
