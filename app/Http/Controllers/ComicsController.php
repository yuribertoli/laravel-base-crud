<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ComicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comic::all(); //salvo nella variabile data tutto il database che passa dal model Comic

        return view('comic.index', compact('data')); //nella index specifica della risorsa passo tutto il database
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'thumb' => 'required|url',
                'description' => 'required|min:20',
                'type' => ['required', Rule::in(['comic book', 'graphic novel'])],
                'price' => 'required|numeric|min:0',
                'series' => 'required|min:5',
                'sale_date' => 'required|date',
                'title' => 'required|min:5'
            ]
        );

        $data = $request->all(); 

        $fumetto = new Comic();

        $fumetto->fill($data);

        $fumetto->save();

        return redirect()->route('comic.show', ['comic' => $fumetto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic) //inietto il parametro variabile, lasciando a Laravel il compito di passare l'ID specifico
    {
        return view('comic.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('comic.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $request->validate(
            [
                'thumb' => 'required|url',
                'description' => 'required|min:20',
                'type' => ['required', Rule::in(['comic book', 'graphic novel'])],
                'price' => 'required|numeric|min:0',
                'series' => 'required|min:5',
                'sale_date' => 'required|date',
                'title' => 'required|min:5'
            ]
        );

        $data = $request->all();
        $comic->update($data);
        $comic->save();
        return redirect()->route('comic.show', ['comic' => $comic ->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('comic.index')->with('status', 'Elemento cancellato');

    }
}
