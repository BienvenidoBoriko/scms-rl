<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Tag;
use App\Meta_tags;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Muestra la vista post.index con todos las entradas
     * ordenadas por fecha de creacion de forma descendente, con una paginacion de
     * siete y sus respectivas categorias y etiquetas
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        return view('post.index', [
            'posts' => Post::with(['tags', 'category'])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    /**
     * Muestra la vista post.create para poder crear una entrada enviandola
     * todos los usuarios, categorias y etiquetas
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('post.create', ['users'=>User::all(),
        'categories' => Category::all(), 'tags'=> Tag::all()
        ]);
    }

    /**
     * Guarda una entrada nueva en la base de
     * datos
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        try {
            $this->validate($request, [
            'title' => ['required','string','max:200'],
            'status' => ['required','string',Rule::in(['publiced','draff']),'max:10'],//draff como borrador
            'author_id' => ['required','integer','max:20'],
            'published_at'=>['nullable','date'],
            'html' => ['required','string'],
            'plain_text' => ['string','nullable'],
            'featured_img' => ['required','string'],
            'featured' => ['required','boolean'],
            'meta_title'=>['required', 'string'],
            'meta_desc'=>['required', 'string'],
            'custom_except' => ['required','string','nullable','max:200'],
            'slug' => ['required','string','max:200'],
            'tags' => ['required','array'],
            'category_id' => ['required','string','nullable']
        ]);
            //verifica si el usuario ha decidio publicar el post y crea una fecha
            if (Str::of($request->status)->exactly('publiced')) {
                $publicationDate=date("Y-m-d H:i:s");
            } else {
                $publicationDate=null;
            }

            $data = [

            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'published_at' => $publicationDate,
            'plain_text' => $request->input('plain_text'),
            'html' => $request->input('html'),
            'featured_img' => $request->input('featured_img'),
            'slug' => $request->input('slug'),
            'user_id' => $request->input('author_id'),
            'featured' => $request->input('featured'),
            'custom_except' => $request->input('custom_except'),
            'category_id' => $request->input('category_id'),
        ];

            $post = Post::create($data);
            $tags = Tag::find($request->input('tags'));
            $post->tags()->attach($tags);
            Meta_tags::create([
                    'name' => 'meta_title',
                    'value'=>$request->input('meta_title'),
                    'post_id'=>$post->id
                ]);

            Meta_tags::create([
                    'name' => 'meta_desc',
                    'value'=>$request->input('meta_desc'),
                    'post_id'=>$post->id
                ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('post.index')->with('success', 'entrada creada correctamente!');
    }

    /**
     *
     * Devuelve la vista post.edit con el post, todas las
     * etiquetas y todas las categorias para poder
     * actualizar un determinado post
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        $post = Post::with('metaTags')->where('id', $id)->first();
        return view('post.edit', ['users'=>User::all(),
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Actualiza un determinado post
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        $this->validate($request, [
            'title' => ['required','string','max:200'],
            'status' => ['required','string',Rule::in(['publiced','draff']),'max:10'],//draff como borrador
            'author_id' => ['required','integer','max:20'],
            'plain_text' => ['string','nullable'],
            'html' => ['required','string'],
            'featured_img' => ['required','string'],
            'featured' => ['required','boolean'],
            'meta_title'=>['required', 'string'],
            'meta_desc'=>['required', 'string'],
            'custom_except' => ['required','string','nullable'],
            'slug' => ['required','string','max:200'],
            'tags' => ['required','array'],
            'category_id' => ['required','string','nullable']
        ]);

        $data = [

            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'plain_text' => $request->input('plain_text'),
            'html' => $request->input('html'),
            'featured_img' => $request->input('featured_img'),
            'slug' => $request->input('slug'),
            'user_id' => $request->input('author_id'),
            'featured' => $request->input('featured'),
            'custom_except' => $request->input('custom_except'),
            'tags' => implode(',', $request->input('tags')),
            'category_id' => $request->input('category_id'),
        ];

        $post->update($data);

        return redirect()->route('post.index')->with('success', 'Entrada actualizada correctamente!');
    }

    /**
     * Filtra los post por categoria o por etiqueta
     *
     * @param Request $request
     * @return View
     */
    public function filterBy(Request $request)
    {
        $this->authorize('viewAny', Post::class);
        $this->validate($request, [
            'filterParameter' => ['required','string','max:20', Rule::in(['category','tag'])],
            'name' => ['required','string','max:200'],
        ]);

        if (Str::of($request->filterParameter)->exactly('tag')) {
            $posts = Post::whereHas('tags', function ($q) use ($request) {
                $q->where('name', '=', $request->name);
            })->orderBy('created_at', 'desc')->paginate(7);
        } elseif (Str::of($request->filterParameter)->exactly('category')) {
            $posts = Post::whereHas('category', function ($q) use ($request) {
                $q->where('name', '=', $request->name);
            })->orderBy('created_at', 'desc')->paginate(7);
        }

        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * cambia el estatus de un post(de publicado a borrador o viseversa)
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function changeStatus(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->validate($request, [
            'status' => ['required','string',Rule::in(['publiced','draff']),'max:10']//draff como borrador
         ]);

        $post->status = $request->status;
        $post->published_at=date("Y-m-d H:i:s");

        $post->save();

        return redirect()->route('post.index')->with('success', 'Estado cambiado correctamente');
    }

    /**
     * Elimina un determinado post
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $post =Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Entrada eliminada correctamente!');
    }
}
