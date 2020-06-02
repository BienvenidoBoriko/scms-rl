@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)
@section('content')

<section class="container-fluid">
    <div class="card pl-3 pr-3">
        <form class="mt-4 mb-2" action="{{ route('post.store') }}" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="title">Titulo<br></label><input name="title"
                            class="form-control @error('title') is-invalid @enderror" type="text"
                            value="{{ old('title') }}" id="title" required="required">
                        <x-error-message name="title" />
                    </div>

                    <div class="col"><label for="slug">slug<br></label><input id="slug" name="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug') }}" type="text">
                        <x-error-message name="slug" />
                    </div>
                </div>
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
                    <div class="col"><label for="custom_except">Descripcion Corta<br></label><textarea
                            name="custom_except" class="form-control @error('custom_except') is-invalid @enderror"
                            id="custom_except">{{ old('custom_except') }}</textarea>
                        <x-error-message name="custom_except" />
                    </div>
                </div>
            </div>
            <div class="form-group"><label for="html">Contenido<br></label><textarea name="html"
                    class="form-control @error('html') is-invalid @enderror"
                    id="html">{{ old('html') }} </textarea>
                <x-error-message name="html" />
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col"><label for="categoria">Categoria<br></label><select name="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" id="categoria">
                            <optgroup label="categorias">
                                @foreach($categories as $category)
                                    @if( $loop->first )
                                        <option value="{{ $category->id }}" selected="selected">
                                            {{ $category->name }}
                                        </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                        <x-error-message name="category_id" />
                    </div>
                    <div class="col">
                        <fieldset class="border border-secondary p-2">
                            <legend class="h6">Etiquetas</legend>
                            @foreach($tags as $tag)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    @if( $loop->first)
                                        <input class="custom-control-input" id="{{ $tag->name }}" type="checkbox"
                                            id="{{ $tag->name }}" checked="checked" name="tags[]"
                                            value="{{ $tag->id }}">
                                    @else
                                        <input class="custom-control-input" id="{{ $tag->name }}" type="checkbox"
                                            name="tags[]" value="{{ $tag->id }}">
                                    @endif
                                    <label class="custom-control-label"
                                        for="{{ $tag->name }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </fieldset>
                        <x-error-message name="tags" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-2">
                        <div class="custom-control custom-radio custom-control-inline ">
                            <input name="featured" class="custom-control-input @error('featured') is-invalid @enderror"
                                type="radio" value="{{ old('featured','1') }} "
                                id="featured"><label class="custom-control-label" for="featured">Destacado</label>
                            <x-error-message name="featured" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <fieldset class="border border-secondary p-2">
                            <legend class="h6">Estado</legend>
                            <div class="custom-control custom-radio">
                                <input type="radio"
                                    {{ old('status')=='publiced'?'checked="checked"':'' }}
                                    id="publiced" value="publiced" name="status"
                                    class="custom-control-input @error('status') is-invalid @enderror">
                                <label class="custom-control-label" for="publiced">Publicar</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio"
                                    {{ old('status')=='draff'?'checked="checked"':'' }}
                                    id="draff" name="status" value="draff" class="custom-control-input">
                                <label class="custom-control-label @error('status') is-invalid @enderror"
                                    for="draff">Guardar
                                    como borrador</label>
                            </div>
                            <x-error-message name="status" />
                        </fieldset>

                    </div>

                    <div class="col-md-3">
                        <label for="autor">Autor<br></label><select name="author_id"
                            class="custom-select @error('author_id') is-invalid @enderror" id="autor">
                            <optgroup label="posibles autores">
                                @foreach($users as $user)
                                    @if( $user->id === Auth::user()->id)
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->name }}
                                        </option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </select>
                        <x-error-message name="author_id" />
                    </div>


                    <div class="col-md-4 mt-4">
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
            <button class="btn btn-primary mr-5" type="submit">Guardar</button>
            <button class="btn btn-primary ml-3 btn-secondary" type="button">Volver</button>
        </form>
    </div>
</section>

<script>
    CKEDITOR.editorConfig = function (config) {
        config.height = '3000';
    };
    CKEDITOR.replace("html", {
        filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
        filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=csrf_token()",
        filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
        filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token=csrf_token()"
    });

</script>
@endsection
