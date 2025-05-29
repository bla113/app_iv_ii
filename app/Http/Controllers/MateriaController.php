<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Http\Requests\StoreMateriaRequest;
use App\Http\Requests\UpdateMateriaRequest;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMateriaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        $materias = Materia::all();

        return response()->json(['materias' => $materias]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function pendientes(Request $request)
    {
        $validate = $request->validate([ //REALIZA LA VALIDACIÓN DE LOS CAMPOS
            'estado' => 'required|max:255',

        ]);
        $materias = Materia::where('estado', $request->estado)->get();
    
        return response()->json(['materias' => $materias]);
    }
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMateriaRequest $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        //
    }
}
