<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CursoController extends Controller
{
    public function index(){
        return Curso::all();
    }

    public function get($id){
        $result = Curso::find($id);
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function lista($id){
        $result=DB::select("select miscursos.alumno, users.nombre, users.apellidos from users,miscursos where miscursos.alumno=users.user and miscursos.curso=?",[$id]);
        return $result;
    }

    public function indextemas($id){
        $result=DB::select("select id, nombre from temas where curso=?",[$id]);
        return $result;
    }

    public function getPr($us){
        //$result = Curso::find($id);
        $result=DB::select("select * from cursos where profesor= ?",[$us]);
        return $result;
    }

    public function create(Request $req){
        $this->validate($req, [
            'profesor'=>'required',
            'nombre'=>'required',
            'descripcion'=>'filled']);

        $datos = new Curso;
        $result = $datos->fill($req->all())->save();
        if($result){
            return response()->json(['status'=>'success'], 200);
        }else{
            return response()->json(['status'=>'failed'], 404);
        }
    }

    public function createTema(Request $req){
        $this->validate($req, [
            'curso'=>'required',
            'nombre'=>'required']);
        $result = DB::insert("insert  into temas (curso,nombre)values (?,?)",[$req->curso,$req->nombre]);
        if($result){
            return response()->json(['status'=>'success'], 200);
        }else{
            return response()->json(['status'=>'failed'], 404);
        }
    }

    public function destroyTema($id){
        //$datos = MisCursos::find($id);
        $datos=DB::select("select * from temas where id = ?",[$id]);
        if(!$datos) {
            return response()->json(['status'=>'failed'], 404);
        }else{
            $result = DB::delete('delete from temas where id=?',[$id]);
            if($result){
                return response()->json(['status'=>'success'], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }  
    }

    public function idret(){
        $result=DB::select("select max(id) from cursos");
        return $result;
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            //'profesor'=>'required',
            'nombre'=>'filled','descripcion'=>'filled']);
        $datos = Curso::find($id);
        if(!$datos){
             return response()->json(['status'=>'failed'], 404);
        }else{
            $result = $datos->fill($req->all())->save();    
            if($result){
                return response()->json(['status'=>'success','cur'=>$datos->nombre], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }     
    }

    public function updateTema(Request $req, $id){
        $this->validate($req, [
            'nombre'=>'filled']);
        $datos = DB::select("select * from temas where id=?",[$id]);
        //$datos->nombre=$req->nombre;
        if(!$datos){
             return response()->json(['status'=>'failed'], 404);
        }else{
            $result = DB::update("update cursos set nombre=? where id=?",[$req->nombre,$id]);    
            if($result){
                return response()->json(['status'=>'success'], 200);
            }else{
                return response()->json(['status'=>'failed'], 404);
            }
        }     
    }

    public function destroy($id){
        
        $datos = Curso::find($id);
        if(!$datos) {
            return response()->json(['status'=>'failed'], 404);
        }else{
            
           $result = $datos->delete();
           if($result){
             return response()->json(['status'=>'success'], 200);
           }else{
             return response()->json(['status'=>'failed'], 404);
           }
        }
    }

}