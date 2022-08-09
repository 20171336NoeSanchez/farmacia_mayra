<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $cita = new Cita();
        $cita->dia = $request->dia;
        $cita->hora = $request->hora;
        $cita->iddoctor = 1;
        $cita->save();

        return redirect()->route('citas.index');
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);
        $cita->update($request->all());

        return redirect()->route('citas.index');
    }

    public function destroy($id)
    {
        $cita = Cita::find($id);
        $cita->delete();
        
        return redirect()->route('citas.index');
    }
}
