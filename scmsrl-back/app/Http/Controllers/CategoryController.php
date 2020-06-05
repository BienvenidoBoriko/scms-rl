<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Category::class);
    }

    /**
     * Devuelve la vista category.index con todas las categorias
     * ordenadas por fecha de creacion de forma descendente, con una paginacion de
     * siete y el recuento de posts de cada una de las categorias
     *
     * @return View
     */
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        return view('category.index', [
            'categories' => Category::withCount('posts')->orderBy('created_at', 'desc')->paginate(7)
        ]);
    }

    /**
     * Muestra la vista category.create para
     * crear una nueva categoria
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('category.create');
    }

    /**
     * Guarda una nueva categoria en la base
     * de datos
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        $this->validate($request, [
            'name' => ['required','string','max:30'],
            'description' => ['required','string','max:250'],
            'featured_img' => ['required','string'],
            'slug' => ['required','string','max:30'],
            'meta_title' => ['required','string','max:70'],
            'meta_desc' => ['required','string','max:200'],
            'visibility'=>['required','string']
        ]);

        $data = [

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'featured_img' => $request->input('featured_img'),
            'slug' => $request->input('slug'),
            'visibility'=>$request->input('visibility'),
            'meta_title' => $request->input('meta_title'),
            'meta_desc' => $request->input('meta_desc')
        ];

        $post = Category::create($data);

        return redirect()->route('category.index')->with('success', 'categoria creada correctamente!');
    }

    /**
     * Muestra la vista para editar una determinada
     * categoria. devuelve la vista category.edit y la
     * categoria
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $this->authorize('update', $category);
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Actualiza una determinada categoria
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->authorize('update', $category);
        $this->validate($request, [
            'name' => ['required','string','max:30'],
            'description' => ['required','string','max:250'],
            'featured_img' => ['required','string'],
            'slug' => ['required','string','max:30'],
            'meta_title' => ['required','string','max:70'],
            'meta_desc' => ['required','string','max:200'],
            'visibility'=>['required',Rule::in(['true','false'])]
        ]);

        $data = [

            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'featured_img' => $request->input('featured_img'),
            'slug' => $request->input('slug'),
            'visibility'=>$request->input('visibility'),
            'meta_title' => $request->input('meta_title'),
            'meta_desc' => $request->input('meta_desc')
        ];

        $category->update($data);

        return redirect()->route('category.index')->with('success', 'categoria actualizada correctamente!');
    }

    /**
     * Busca una determinada categoria
     *
     * @param Request $request
     * @return View
     */
    public function filterBy(Request $request)
    {
        $this->authorize('viewAny', Category::class);

        $this->validate($request, [
            'filterParameter' => ['required','string','max:20', Rule::in(['name'])],
            'name' => ['required','string','max:200'],
        ]);

        if (Str::of($request->filterParameter)->exactly('name')) {
            $categories = Category::where('name', '=', $request->name)->orderBy('created_at', 'desc')->paginate(7);
        }

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Elimina una determinada categoria
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'categoria eliminada correctamente!');
    }
}
