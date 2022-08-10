<?php

namespace App\Http\Controllers;

use App\Models\Agendado;
use Illuminate\Http\Request;

class AgendadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $agendados = Agendado::join("citas","agendados.idcita","=","citas.id")
        
        ->get();
        return view('agendados.index', compact('agendados'));
    }
}
