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

    public function idret(){
        $result=DB::select("select max(id) from cursos");
        return $result;
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'profesor'=>'required','nombre'=>'filled','descripcion'=>'filled']);
        $datos = Curso::find($id);
        //$datos->profesor = $req->profesor;
        //$datos->nombre = $req->nombre;
        //$datos->descripcion = $req->descripcion;
        //$result=DB::update(
        //    'update cursos set profesor=?, nombre=?,descripcion=? where id=?',
        //    [$datos->profesor,$datos->nombre,$datos->descripcion,$id]
        //);
        if(!$datos){
             return response()->json(['status'=>'failed'], 404);
        }else{
            $result = $datos->fill($req->all())->save();      
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