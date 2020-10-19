<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Filmes;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;

class FilmesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmes = Filmes::where('user_id', Auth::id())->orderBy('created_at')->paginate();
        return view('filmes.index', compact('filmes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('filmes.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'min:3', 'max:100'],
            'autor' => ['required', 'string', 'min:3', 'max:100', 'different:nome'],
            'resumo' => ['string', 'min:15', 'max:255', 'nullable', 'alpha_dash', 'alpha_num'],
            'nota' => ['required', 'integer', 'min:1', 'max:11', 'numeric'],
            'image' => ['required', 'mimes:jpeg,png', 'dimensions:min_width=200,min_height=200', 'image', 'file'],
            'tags_id' => ['array', 'required', 'bail'],
        ]);

        $filmes = new Filmes($validatedData);
        $filmes->user_id = Auth::id();
        $filmes->save();
        $filmes->tags()->attach($validatedData['tags_id']);



        if ($request->hasFile('image') and $request->file('image')->isValid()) {
            $path = $request->file('image')->store('filme');
            $image = new Image();
            $image->filmes_id = $filmes->id;
            $image->path = $path;
            $image->save();
        }

        return redirect('filmes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Filmes $filme)
    {
        return view('filmes.show', compact('filme'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Filmes $filme)
    {
        $tags = Tag::all();
        return view('filmes.edit', compact('filme', 'tags'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filmes $filme)
    {
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'min:3', 'max:100'],
            'autor' => ['required', 'string', 'min:3', 'max:100', 'different:nome'],
            'resumo' => ['string', 'min:15', 'max:255', 'nullable', 'alpha_dash', 'alpha_num'],
            'nota' => ['required', 'integer', 'min:1', 'max:11', 'numeric'],
            'image' => ['required', 'mimes:jpeg,png',  'dimensions:min_width=200,min_height=200', 'image', 'file'],
            'tags_id' => ['array', 'required', 'bail'],
        ]);

        if ($filme->user_id === Auth::id()) {
            $filme->update($request->all());
            $filme->tags()->sync($validatedData['tags_id']);

            if ($request->hasFile('image') and $request->file('image')->isValid()) {
                $filme->image->delete();
                $path = $request->file('image')->store('filme');
                $image = new Image();
                $image->filmes_id = $filme->id;
                $image->path = $path;
                $image->save();
            }

            return redirect()->route('filmes.index');
        } else {
            return redirect()->route('filmes.index')->with('error', 'voce nao pode.logue-se')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filmes $filme)
    {
        if ($filme->user_id === Auth::id()) {
            $path = $filme->image->path;
            $filme->delete();
            Storage::disk('public')->delete($path);
            return redirect()->route('filmes.index');
        }
    }
}
