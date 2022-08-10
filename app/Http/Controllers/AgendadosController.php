<?php

namespace App\Http\Controllers;

use App\Models\Agendado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class AgendadosController extends Controller
{
    public function index()
    {
        $id = auth()->id();
        
        $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad, a.nombrepaciente FROM citas AS c JOIN users AS u JOIN agendados AS a WHERE c.iddoctor = u.id AND c.id = a.idcita AND c.iddoctor='.$id.' ORDER BY c.dia DESC, c.hora ASC';
        $agendados = DB::select($sql);
        return view('agendados.index', compact('agendados'));
    }

    public function agendar(Request $request)
    {
        $agendado = new Agendado();
        $agendado->idcita = $request->idcita;
        $agendado->nombrepaciente = $request->nombrepaciente;
        $agendado->estatus = 1;
        $agendado->save();

        $sql = 'UPDATE citas SET estatus = 1 WHERE id = '.$request->idcita;
        DB::update($sql);

        return redirect()->route('citas.index');
    }

    public function pdf()
    {
        $id = auth()->id();
        $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad, a.nombrepaciente FROM citas AS c JOIN users AS u JOIN agendados AS a WHERE c.iddoctor = u.id AND c.id = a.idcita AND c.iddoctor='.$id.' ORDER BY c.dia DESC, c.hora ASC';
        $agendados = DB::select($sql);

        $pdf = PDF::loadView('agendados.pdf',['agendados'=>$agendados]);
        
        return $pdf->download('Pacientes_agendados.pdf');

        //return view('agendados.pdf', compact('agendados'));
    }
}
