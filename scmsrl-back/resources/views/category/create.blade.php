@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section class="container-fluid">
    <div class="card pl-3 pr-3">
        <form class="mt-4 mb-2" id="category-create-form" action="{{ route('category.store') }}"
            method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="form-row">
                    <div class="col"><label for="name">nombre<br></label><input name="name"
                            class="form-control @error('name') is-invalid @enderror" type="text"
                            value="{{ old('name') }}" id="name" required="required">
                        <x-error-message name="name" />
                    </div>
                    <div class="col"><label for="slug">slug<br></label><input id="slug"
                            value="{{ old('slug') }}" name="slug"
                            class="form-control @error('slug') is-invalid @enderror" type="text">
                        <x-error-message name="slug" />
                    </div>
                </div>
            </div>
            <div class="form-group"><label for="description">descripcion<br></label><textarea
                    class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description">{{ old('description') }}</textarea>
                <x-error-message name="description" />
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col"><label for="meta_desc">Meta Descripcion<br></label><textarea name="meta_desc"
                            class="form-control @error('meta_desc') is-invalid @enderror"
                            id="meta_desc">{{ old('meta_desc') }}</textarea>
                        <x-error-message name="meta_desc" />
                    </div>
                    <div class="col"><label for="meta_title">Meta Titulo<br></label><textarea name="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror"
                            id="meta_title">{{ old('meta_title') }}</textarea>
                        <x-error-message name="meta_title" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <fieldset class="p-2">
                            <legend class="h6">imagen de cabezera</legend>
                            <div class="form-row">
                                <div class="col-md-4 pr-0">
                                    <a href="#" id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Cargar
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0">
                                    <input id="thumbnail"
                                        class="form-control @error('featured_img') is-invalid @enderror" type="text"
                                        value="{{ old('featured_img') }}" name="featured_img">
                                    <x-error-message name="featured_img" />
                                </div>
                            </div>
                            <div id="holder" class="image-box text-center">
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check"><input class="form-check-input @error('visibility') is-invalid @enderror"
                        name="visibility" value="si" type="radio" id="visibility"><label class="form-check-label"
                        for="visibility">que se muestre en la pagina principal</label>
                    <x-error-message name="visibility" />
                </div>
            </div><button class="btn btn-primary mr-5" type="submit">Guardar</button><button
                class="btn btn-primary ml-3 btn-secondary" type="button">Volver</button>
        </form>
    </div>
</section>

@endsection
