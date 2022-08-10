<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
   

    public function index()
    {
        $id = auth()->id();
        if($id != null){
            $sql = 'SELECT * FROM citas WHERE iddoctor='.$id;
            $citas = DB::select($sql);
        }else{
            $sql = 'SELECT * FROM citas';
            $citas = DB::select($sql);
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
