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
            'nombre'=>'filled','descripcion'=>'filled']);

        $datos = Curso::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){
        
        $datos = Curso::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->delete();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

}