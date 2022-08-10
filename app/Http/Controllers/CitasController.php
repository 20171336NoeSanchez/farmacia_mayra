<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
   
    public function index(Request $request)
    {
        $id = auth()->id();
        $buscar = $request->get('buscarpor');
        $tipo = "";
        $tipocamp = $request->get('tipo');
        if ($tipocamp=="Doctor"){
            $tipo = "name";
        }else if ($tipocamp=="Especialidad"){
            $tipo = "especialidad";
        }
        if ( ($tipo) && ($buscar) ) {
            if($id != null){
                $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad FROM citas AS c JOIN users AS u WHERE c.iddoctor = u.id AND c.iddoctor='.$id.' AND u.'.$tipo." like '%".$buscar."%'";
                $citas = DB::select($sql);
            }else{
                $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad FROM citas AS c JOIN users AS u WHERE c.iddoctor = u.id AND u.'.$tipo." like '%".$buscar."%'";
                $citas = DB::select($sql);
            }
        }else{
            if($id != null){
                $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad FROM citas AS c JOIN users AS u WHERE c.iddoctor = u.id AND c.iddoctor='.$id;
                $citas = DB::select($sql);
            }else{
                $sql = 'SELECT c.id, c.dia, c.hora, u.id AS idusuario, u.name, u.especialidad FROM citas AS c JOIN users AS u WHERE c.iddoctor = u.id ';
                $citas = DB::select($sql);
            }

        }
       
        return view('citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $id = auth()->id();

        $cita = new Cita();
        $cita->dia = $request->dia;
        $cita->hora = $request->hora;
        $cita->iddoctor = $id;
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
