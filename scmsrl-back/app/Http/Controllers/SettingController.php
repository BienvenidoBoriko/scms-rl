<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Config;

class SettingController extends Controller
{

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->authorizeResource(Setting::class, 'setting');
    }

    /**
     * Muestra los ajustes de la aplicacion
     *
     * @return View
     */
    public function index()
    {
        return view('setting.index', ['siteTitle'=>Setting::where('name', 'title')->first(),
        'cover_img'=>Setting::where('name', 'cover_img')->first(),
        'desc'=>Setting::where('name', 'desc')->first(),'lang'=>Setting::where('name', 'lang')->first(),
        'facebook'=>Setting::where('name', 'facebook')->first(),'twitter'=>Setting::where('name', 'twitter')->first(),
        'email'=>Setting::where('name', 'email')->first(),'github'=>Setting::where('name', 'github')->first()
        ]);
    }

    /**
     * Actualiza los ajustes de la pagina
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required','string','max:200'],
            'desc' => ['required','string','max:250'],
            'lang' => ['required','string','max:10'],
            'cover_img' => ['required','string'],
            'facebook' => ['required','string','max:200'],
            'twitter' => ['required','string','max:200'],
            'email' => ['required','string','max:200'],
            'github' => ['required','string','max:200']
        ]);

        $data = [

            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'lang' => $request->input('lang'),
            'cover_img' => $request->input('cover_img'),
            'facebook' => $request->input('facebook'),
            'twitter' => $request->input('twitter'),
            'email' => $request->input('email'),
            'github' => $request->input('github'),
        ];



        foreach ($data as $name => $value) {
            $data = [
                'name' => $name,
                'value' => $value,
                'type' => 'page'
            ];
            $setting = Setting::where('name', $name);
            $setting->update($data);
        }
        return redirect()->route('setting.index')->with('success', 'ajustes guardados correctamente!');
    }
}
