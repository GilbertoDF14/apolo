<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TemaController extends Controller
{


    public function update(Request $req, $id){
        $this->validate($req, [
            'nombre'=>'filled']);
        $datos = Tema::find($id);
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


}