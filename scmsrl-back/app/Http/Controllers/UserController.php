<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\rol;
use DB;
use App\Meta_tags;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('author.index', [
            'authors' => User::with('rol')->withCount('posts')->orderBy('created_at', 'desc')->paginate(7)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('author.create', [
            'rols'=> rol::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'profile_img'=>['required', 'string'],
            'cover_img'=>['required', 'string'],
            'bio'=>['required', 'string', 'max:255'],
            'github'=>['string', 'max:70'],
            'website'=>['string', 'max:100'],
            'facebook'=>['string', 'max:100'],
            'twitter'=>['string', 'max:50'],
            'slug'=>['required', 'string', 'max:50'],
            'rol_id'=>['required', 'integer'],
            'meta_title'=>['required', 'string'],
            'meta_desc'=>['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $user= User::create([
                'name' => $request['name'],
                'status'=>'ofline',
                'profile_img'=>$request['profile_img'],
                'cover_img'=>$request['cover_img'],
                'bio'=>$request['bio'],
                'github'=>$request['github'],
                'website'=>$request['website'],
                'facebook'=>$request['facebook'],
                'twitter'=>$request['twitter'],
                'slug'=>$request['slug'],
                'rol_id'=>$request['rol_id'],
                'meta_title'=>$request['meta_title'],
                'meta_desc'=>$request['meta_desc'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                ]);

        return redirect()->route('author.index')->with('success', 'autor creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        return view('author.edit', [
            'author' => $user,
            'rols'=> rol::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'profile_img'=>['required', 'string'],
            'cover_img'=>['required', 'string'],
            'bio'=>['required', 'string', 'max:255'],
            'github'=>['string', 'max:70'],
            'website'=>['string', 'max:100'],
            'twitter'=>['string', 'max:50'],
            'facebook'=>['string', 'max:100'],
            'slug'=>['required', 'string', 'max:50'],
            'rol_id'=>['required', 'integer'],
            'meta_title'=>['required', 'string'],
            'meta_desc'=>['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        $data=([
                'name' => $request['name'],
                'status'=>'ofline',
                'profile_img'=>$request['profile_img'],
                'cover_img'=>$request['cover_img'],
                'bio'=>$request['bio'],
                'github'=>$request['github'],
                'website'=>$request['website'],
                'twitter'=>$request['twitter'],
                'facebook'=>$request['facebook'],
                'slug'=>$request['slug'],
                'rol_id'=>$request['rol_id'],
                'meta_title'=>$request['meta_title'],
                'meta_desc'=>$request['meta_desc'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                ]);

        $user->update($data);

        return redirect()->route('author.index')->with('success', 'autor actualizado correctamente!');
    }

    public function filterBy(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $this->validate($request, [
            'filterParameter' => ['required','string','max:20', Rule::in(['name','rol'])],
            'value' => ['required','string','max:200'],
        ]);

        if (Str::of($request->filterParameter)->exactly('rol')) {
            $authors = User::whereHas('rol', function ($q) use ($request) {
                $q->where('name', '=', $request->value);
            })->orderBy('created_at', 'desc')->paginate(7);
        } elseif (Str::of($request->filterParameter)->exactly('name')) {
            $authors = User::where('name', '=', $request->value)->orderBy('created_at', 'desc')->paginate(7);
        }

        return view('author.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('author.index')->with('success', 'usuario eliminado correctamente!');
    }
}