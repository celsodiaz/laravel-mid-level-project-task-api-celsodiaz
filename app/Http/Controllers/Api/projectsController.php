<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class projectsController extends Controller
{
    public function index (){
        $project = Project::all();
        $data = [
            'projects' => $project,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    
    public function crear (Request $request) {

        $validator = Validator::make($request->all(), [
            'name'=> 'required|min:3|max:100',
            'status'=> 'required'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
         return response()->json($data,400);   
        }

        $project = Project::create([
                        'name'=> $request->name,
                        'status'=>$request->status,
                        'description'=>$request->description
                    ]);
        
        if(!$project){
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data,500);
        };
        
        $data = [
            'project'=> $project,
            'status' => 201
        ];

        return response()->json($data,201);
        
    }

    public function mostrar($id){
         $project = Project::find($id);

       if(!$project) {
            $data = [
                'message' => 'Projecto no se encontro',
                'status' => 404
            ];
            return response()->json($data,404);
       }

       $data = [
                'message' => $project,
                'status' => 200
            ];

        return response()->json($data,200);
    }

    public function eliminar($id){

       $project = Project::find($id);

       if(!$project) {
            $data = [
                'message' => 'Projecto no se encontro',
                'status' => 404
            ];
            return response()->json($data,404);
       }

       $project->delete();

       $data = [
                'message' => 'Projecto eliminado',
                'status' => 200
            ];

        return response()->json($data,200);

    }

    public function actualizar(Request $request, $id){
         $project = Project::find($id);

        if(!$project) {
                $data = [
                    'message' => 'Projecto no se encontro',
                    'status' => 404
                ];
                return response()->json($data,404);
        }

       $validator = Validator::make($request->all(), [
                'name'=> 'required|min:3|max:100',
                'status'=> 'required'
            ]);
        
        if($validator->fails()){
           $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
         return response()->json($data,400);  
        }

        $project->name= $request->name;
        $project->description= $request->description;
        $project->status=$request->status;

        $project->save();
        $data = [
                'message' => 'Datos actualizados',
                'project' => $project,
                'status' => 200
            ];
         return response()->json($data,200);  
    }
}
