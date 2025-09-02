<?php

namespace App\Http\Controllers;

use App\Models\AsientoContable;
use Illuminate\Http\Request;

class AsientoContableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asientos = AsientoContable::all();
        return view('asientos.index', compact('asientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'monto_debe' => 'required|numeric',
            'monto_haber' => 'required|numeric',
            'cuenta_debe' => 'required|string|max:255',
            'cuenta_haber' => 'required|string|max:255',
        ]);

        AsientoContable::create($request->all());

        return redirect()->route('asientos.index')->with('success', 'Asiento contable creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asiento = AsientoContable::findOrFail($id);
        return view('asientos.show', compact('asiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asiento = AsientoContable::findOrFail($id);
        return view('asientos.edit', compact('asiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $asiento = AsientoContable::findOrFail($id);
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'monto_debe' => 'required|numeric',
            'monto_haber' => 'required|numeric',
            'cuenta_debe' => 'required|string|max:255',
            'cuenta_haber' => 'required|string|max:255',
        ]);

        $asiento->update($request->all());

        return redirect()->route('asientos.index')->with('success', 'Asiento contable actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asiento = AsientoContable::findOrFail($id);
        $asiento->delete();

        return redirect()->route('asientos.index')->with('success', 'Asiento contable eliminado con éxito.');
    }
}
