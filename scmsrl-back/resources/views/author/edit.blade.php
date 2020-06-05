@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section class="container-fluid">
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card pl-3 pr-3">
                <div class="card-body">
                    <div class="m-t-30 text-center"> <img src="{{ $author->profile_img }}" class="rounded-circle mb-2"
                            width="150" height="150" alt="imagen de usuario" />
                        <h4 class="card-title m-t-10">{{ $author->name }}</h4>
                        <h6 class="card-subtitle">
                            {{ $author->rol_id==1?'administrador':'autor' }}
                        </h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4">
                                <div class="font-medium">numero de entradas: {{ $author->posts_count }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Correo </small>
                    <h6>{{ $author->email }}</h6> <small class="text-muted p-t-30 db">Social Profile</small>
                    <br />
                    <a href="{{ $author->facebook }}" class="btn btn-circle btn-secondary"><i
                            class="fab fa-facebook"></i></a>
                    <a href="{{ $author->twitter }}" class="btn btn-circle btn-secondary"><i
                            class="fab fa-twitter-square"></i></a>
                    <a href="{{ $author->website }}" class="btn btn-circle btn-secondary"><i
                            class="fab fa-firefox"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <form class="mt-4 mb-2" id="author-create-form"
                    action="{{ route('author.update',$author->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab"
                                aria-controls="basic" aria-selected="true">Basico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab"
                                aria-controls="media" aria-selected="false">Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rs-tab" data-toggle="tab" href="#rs" role="tab" aria-controls="rs"
                                aria-selected="false">Redes sociales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="meta-tab" data-toggle="tab" href="#meta" role="tab"
                                aria-controls="meta" aria-selected="false">Meta</a>
                        </li>
                    </ul>
                    <div class="tab-content ml-3 mr-3 mt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-12"><label
                                            for="name">Nombre:<br></label><input id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $author->name }}" type="text" required="required">
                                        <x-error-message name="name" />
                                    </div>

                                    <div class="form-group col-md-4 col-sm-12"><label
                                            for="password">Contraseña:<br></label><input name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            type="password">
                                        <x-error-message name="password" />
                                    </div>
                                </div>
                                <div class="form-group"><label for="email">Correo:<br></label><input name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $author->email }}" id="email" type="email">
                                    <x-error-message name="email" />
                                </div>
                                @can('changeRol', $author)
                                    <div class="form-group"><label for="rol_id">Rol:<br></label><select id="rol_id"
                                            name="rol_id" class="custom-select @error('rol_id') is-invalid @enderror">
                                            <optgroup label="Roles">
                                                @foreach($rols as $rol)
                                                    <option value="{{ $rol->id }}"
                                                        selected="{{ $author->rol_id==$rol->id?'selected':'' }}">
                                                        {{ $rol->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <x-error-message name="rol_id" />
                                    </div>
                                @endcan
                                @cannot('changeRol', $author)
                                    <p>
                                        @foreach($rols as $rol)
                                            @if($author->rol_id==$rol->id)
                                                Role: {{ $rol->name }}
                                            @endif
                                        @endforeach
                                    </p>
                                @endcan
                                <div class="form-group"><label for="slug">Slug:<br></label><input name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ $author->slug }}" id="slug" type="text">
                                    <x-error-message name="slug" />
                                </div>

                            </div>
                            <div class="form-group"><label for="bio">Biografia:<br></label><textarea name="bio"
                                    class="form-control @error('bio') is-invalid @enderror"
                                    id="bio">{{ $author->bio }}</textarea>
                                <x-error-message name="bio" />
                            </div>
                        </div>

                        <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <fieldset class="p-2">
                                            <legend class="h6">Imagen de Usuario:</legend>
                                            <div class="form-row">
                                                <div class="col-md-4 pr-0">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Cargar
                                                    </a>
                                                </div>
                                                <div class="col-md-8 pl-0">
                                                    <input id="thumbnail"
                                                        class="form-control @error('profile_img') is-invalid @enderror"
                                                        type="text" value="{{ $author->profile_img }}"
                                                        name="profile_img">
                                                    <x-error-message name="profile_img" />
                                                </div>
                                            </div>
                                            <div id="holder" class="image-box text-center">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col">
                                        <fieldset class="p-2">
                                            <legend class="h6">Imagen de Cabecera:</legend>
                                            <div class="form-row">
                                                <div class="col-md-4 pr-0">
                                                    <a id="lfm2" data-input="thumbnail1" data-preview="holder1"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Cargar
                                                    </a>
                                                </div>
                                                <div class="col-md-8 pl-0">
                                                    <input id="thumbnail1"
                                                        class="form-control @error('cover_img') is-invalid @enderror"
                                                        type="text" value="{{ $author->cover_img }}" name="cover_img">
                                                    <x-error-message name="cover_img" />
                                                </div>
                                            </div>
                                            <div id="holder1" class="image-box text-center">
                                            </div>

                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="rs" role="tabpanel" aria-labelledby="rs-tab">

                            <div class="form-group"><label for="website">Pagina Web:<br></label><input name="website"
                                    class="form-control @error('website') is-invalid @enderror" type="text"
                                    value="{{ $author->website }}" id="website" required="required">
                                <x-error-message name="website" />
                            </div>
                            <div class="form-group"><label for="github">Github:<br></label><input
                                    value="{{ $author->github }}" id="github" name="github"
                                    class="form-control @error('github') is-invalid @enderror" type="text">
                                <x-error-message name="github" />
                            </div>
                            <div class="form-group"><label for="twitter">Twitter:<br></label><input id="twitter"
                                    value="{{ $author->twitter }}" name="twitter"
                                    class="form-control @error('twitter') is-invalid @enderror" type="text">
                                <x-error-message name="twitter" />
                            </div>
                            <div class="form-group"><label for="facebook">Facebook:<br></label><input id="facebook"
                                    value="{{ $author->facebook }}" name="facebook"
                                    class="form-control @error('facebook') is-invalid @enderror" type="text">
                                <x-error-message name="facebook" />
                            </div>

                        </div>
                        <div class="tab-pane fade" id="meta" role="tabpanel" aria-labelledby="meta-tab">

                            <div class="form-group"><label for="meta_desc">Meta Descripcion:<br></label><textarea
                                    name="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror"
                                    id="meta_desc">{{ $author->meta_desc }}</textarea>
                                <x-error-message name="meta_desc" />
                            </div>
                            <div class="form-group"><label for="meta_title">Meta Titulo:<br></label><textarea
                                    name="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                                    id="meta_title">{{ $author->meta_title }}</textarea>
                                <x-error-message name="meta_title" />
                            </div>

                        </div>
                    </div>
                    <div class="mr-3 ml-3">
                        <button class="btn btn-primary mr-5" type="submit">Guardar</button><button
                            class="btn btn-primary ml-3 btn-secondary" type="button">Volver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection
