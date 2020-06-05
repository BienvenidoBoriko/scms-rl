<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Muestra la vista tag.index con todos las etiquetas
     * ordenadas por fecha de creacion de forma descendente, con una paginacion de
     * siete y el numero de post que tiene
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        return view('tag.index', [
            'tags' => Tag::withCount('posts')->orderBy('created_at', 'desc')->paginate(7)
        ]);
    }

    /**
     * Muestra la tag.create para poder crear una etiqueta
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('tag.create');
    }

    /**
     * Guarda una nueva etiqueta
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);
        $this->validate($request, [
            'name' => ['required','string','max:30'],
            'description' => ['required','string','max:250'],
            'featured_img' => ['required','string'],
            'slug' => ['required','string','max:30'],
            'meta_title' => ['required','string','max:70'],
            'meta_desc' => ['required','string','max:200'],
        ]);

        $data = [

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'featured_img' => $pathFeaturedImg,
            'slug' => $request->input('slug'),
            'meta_title' => $request->input('meta_title'),
            'meta_desc' => $request->input('meta_desc'),
        ];

        $post = Tag::create($data);

        return redirect()->route('tag.index')->with('success', 'etiqueta creada correctamente!');
    }

    /**
     * Devuelve la vista tag.edit con la etiqueta para
     * poder editarla
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        $this->authorize('update', $tag);
        return view('tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Actualiza una determinada etiqueta
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $this->authorize('update', $tag);
        $this->validate($request, [
            'name' => ['required','string','max:30'],
            'description' => ['required','string','max:250'],
            'featured_img' => ['required','string'],
            'slug' => ['required','string','max:30'],
            'meta_title' => ['required','string','max:70'],
            'meta_desc' => ['required','string','max:200'],
        ]);

        $data = [

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'featured_img' => $request->input('featured_img'),
            'slug' => $request->input('slug'),
            'meta_title' => $request->input('meta_title'),
            'meta_desc' => $request->input('meta_desc')
        ];

        $tag->update($data);

        return redirect()->route('tag.index')->with('success', 'Etiqueta actualizada correctamente!');
    }

    /**
     * Buesca una determinada etiqueta
     *
     * @param Request $request
     * @return View
     */
    public function filterBy(Request $request)
    {
        $this->authorize('viewAny', Tag::class);
        $this->validate($request, [
            'filterParameter' => ['required','string','max:20', Rule::in(['name'])],
            'name' => ['required','string','max:200'],
        ]);

        if (Str::of($request->filterParameter)->exactly('name')) {
            $tags = Tag::where('name', '=', $request->name)->orderBy('created_at', 'desc')->paginate(7);
        }

        return view('tag.index', [
            'tags' => $tags
        ]);
    }

    /**
     * Elimina una etiqueta de la base de datos
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $tag= Tag::find($id);
        $this->authorize('delete', $tag);
        $tag->delete();
        return redirect()->route('tag.index')->with('success', 'Etiqueta eliminada correctamente!');
    }
}
