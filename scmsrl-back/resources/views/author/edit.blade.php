@extends('layouts.app')

@php
    $title = config('titles.' . Route::currentRouteName());
@endphp
@section('title', $title)

@section('content')

<section>
    <div class="card">
    <form class="mt-4 mb-2" id="author-create-form" action="{{ route('author.update',$author->id) }}" method="POST"
    enctype="multipart/form-data">
    @method('put')
        @csrf
        <div class="form-group">
            <div class="form-row">
                <div class="col col-sm-4 col-lg-3"><label for="name">Nombre<br></label><input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{$author->name}}" type="text" required="required">
                <x-error-message name="name"/>
                </div>
                <div class="col col-sm-4 col-lg-3"><label for="email">correo<br></label><input name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{$author->email}}"  id="email"  type="email">
                <x-error-message name="email"/>
                </div>
                <div class="col col-sm-4 col-lg-2"><label for="password">contraseña<br></label><input name="password" class="form-control @error('password') is-invalid @enderror"
                     id="password" type="password">
                    <x-error-message name="password"/>
                    </div>
                <div class="col col-sm-4 col-lg-2"><label for="rol_id">rol<br></label><select id="rol_id" name="rol_id" class="custom-select @error('rol_id') is-invalid @enderror">
                        <optgroup label="Roles">
                            @foreach($rols as $rol)
                                <option value="{{$rol->id}}" selected="{{$author->rol_id==$rol->id?'selected':''}}">{{$rol->name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                <x-error-message name="rol_id"/>
                </div>
                <div class="col col-sm-4 col-lg-2"><label for="slug">slug<br></label><input name="slug" class="form-control @error('slug') is-invalid @enderror"
                    value= "{{$author->slug}}" id="slug"  type="text">
                <x-error-message name="slug"/>
                </div>
            </div>
        </div>
        <div class="form-group"><label for="bio">biografia<br></label><textarea name="bio" class="form-control @error('bio') is-invalid @enderror"
                id="bio" >{{$author->bio}}</textarea>
            <x-error-message name="bio"/>
            </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col"><label for="website">pagina web<br></label><input name="website" class="form-control @error('website') is-invalid @enderror" type="text"
                    value= "{{$author->website}}"    id="website" required="required">
                <x-error-message name="website"/>
                </div>
                <div class="col"><label for="github">github<br></label><input value="{{$author->github}}" id="github" name="github" class="form-control @error('github') is-invalid @enderror" type="text">
                <x-error-message name="github"/>
                </div>
                <div class="col"><label for="twitter">twitter<br></label><input id="twitter" value= "{{$author->twitter}}" name="twitter" class="form-control @error('twitter') is-invalid @enderror" type="text">
                <x-error-message name="twitter"/>
                </div>
                <div class="col"><label for="facebook">facebook<br></label><input id="facebook" value= "{{$author->facebook}}" name="facebook" class="form-control @error('facebook') is-invalid @enderror" type="text">
                <x-error-message name="facebook"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col"><label for="meta_desc">Meta Descripcion<br></label><textarea name="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror"
                        id="meta_desc">{{$author->meta_desc}}</textarea>
                    <x-error-message name="meta_desc"/>
                    </div>
                <div class="col"><label for="meta_title">Meta Titulo<br></label><textarea name="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                        id="meta_title">{{$author->meta_title}}</textarea>
                    <x-error-message name="meta_title"/>
                    </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <fieldset class="p-2">
                        <legend class="h6">imagen de Usuario</legend>
                        <div class="form-row">
                            <div class="col-md-4 pr-0">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Cargar
                                </a>
                            </div>
                            <div class="col-md-8 pl-0">
                                <input id="thumbnail" class="form-control @error('profile_img') is-invalid @enderror" type="text" value="{{ $author->profile_img }}" name="profile_img">
                                <x-error-message name="profile_img" />
                            </div>
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:100px;">
                    </fieldset>
                </div>
                <div class="col">
                    <fieldset class="p-2">
                        <legend class="h6">imagen de cabecera</legend>
                        <div class="form-row">
                            <div class="col-md-4 pr-0">
                                <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Cargar
                                </a>
                            </div>
                            <div class="col-md-8 pl-0">
                                <input id="thumbnail2" class="form-control @error('cover_img') is-invalid @enderror" type="text" value="{{ $author->cover_img }}" name="cover_img">
                                <x-error-message name="cover_img" />
                            </div>
                        </div>
                        <img id="holder2" style="margin-top:15px;max-height:100px;">
                    </fieldset>
                </div>
            </div>
        </div><button class="btn btn-primary mr-5" type="submit">Guardar</button><button
            class="btn btn-primary ml-3 btn-secondary" type="button">Volver</button>
    </form>
    </div>
</section>
@endsection
