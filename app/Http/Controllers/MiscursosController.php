<?php

namespace App\Http\Controllers;

use App\Models\MisCursos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MisCursosController extends Controller
{
    public function index($us){
        //return MisCursos::all();
        //$result=DB::select("select * from miscursos where alumno = ?",[$us]);
        $result=DB::select("select miscursos.id, cursos.id as cursoid, cursos.nombre, cursos.profesor, cursos.descripcion from miscursos,cursos where miscursos.curso=cursos.id and alumno = ?",[$us]);
        return $result;
    }

    public function get($id){
        $result = MisCursos::find($id);
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function create(Request $req){
        $this->validate($req, [
            'curso'=>'required',
            'alumno'=>'required']);

        $datos = new MisCursos;
        $datos->curso = $req->curso;
        $datos->alumno = $req->alumno;
        $result=DB::insert('insert into miscursos (curso,alumno) values (?,?)',[$datos->curso,$datos->alumno]);
        //$result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'curso'=>'filled','alumno'=>'filled']);

        $datos = MisCursos::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){
        //$datos = MisCursos::find($id);
        $datos=DB::select("select * from miscursos where id = ?",[$id]);
        if(!$datos) {
            return response()->json(['status'=>'failed'], 404);
        }else{
            $result = DB::delete('delete from miscursos where id=?',[$id]);
            if($result){
                return response()->json(['status'=>'success'], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }    
    }

}