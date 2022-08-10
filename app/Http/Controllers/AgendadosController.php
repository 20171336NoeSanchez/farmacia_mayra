<?php

namespace App\Http\Controllers;

use App\Models\Agendado;
use Illuminate\Http\Request;

class AgendadosController extends Controller
{
    public function index()
    {
        $agendados = Agendado::join("citas","agendados.idcita","=","citas.id")
        ->get();
        return view('agendados.index', compact('agendados'));
    }

    public function agendar(Request $request)
    {
        $agendado = new Agendado();
        $agendado->idcita = $request->idcita;
        $agendado->nombrepaciente = $request->nombrepaciente;
        $agendado->estatus = 1;
        $agendado->save();

        return redirect()->route('citas.index');
    }
}
