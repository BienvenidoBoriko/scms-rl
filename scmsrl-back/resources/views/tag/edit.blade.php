@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section>
    <div class="card">
        <form class="mt-4 mb-2" id="tag-create-form" action="{{ route('tag.update',$tag->id) }}"
            method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <div class="col"><label for="name">nombre<br></label><input
                            class="form-control @error('name') is-invalid @enderror" type="text"
                            value="{{ $tag->name }}" id="name" name="name" id="titulo" required="required">
                        <x-error-message name="name" />
                    </div>
                    <div class="col"><label for="slug">slug<br></label><input name="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ $tag->slug }}"
                            id="slug" type="text">
                        <x-error-message name="slug" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">descripcion<br></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description">
                {{ $tag->description }}</textarea>
                <x-error-message name="description" />
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col"><label for="meta_desc">Meta Descripcion<br></label><textarea name="meta_desc"
                            class="form-control @error('meta_desc') is-invalid @enderror"
                            id="meta_desc">{{ $tag->meta_desc }}</textarea>
                        <x-error-message name="meta_desc" />
                    </div>
                    <div class="col"><label for="meta_title">Meta Titulo<br></label><textarea name="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror"
                            id="meta_title">{{ $tag->meta_title }}</textarea>
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
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Cargar
                                    </a>
                                </div>
                                <div class="col-md-8 pl-0">
                                    <input id="thumbnail"
                                        class="form-control @error('featured_img') is-invalid @enderror" type="text"
                                        value="{{ $tag->featured_img }}" name="featured_img">
                                    <x-error-message name="featured_img" />
                                </div>
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </fieldset>
                    </div>
                </div>
            </div><button class="btn btn-primary mr-5" type="submit">Guardar</button><button
                class="btn btn-primary ml-3 btn-secondary" type="button">Volver</button>
        </form>
    </div>
</section>

@endsection
