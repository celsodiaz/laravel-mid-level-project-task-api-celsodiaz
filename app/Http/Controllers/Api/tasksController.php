<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tasksController extends Controller
{
    public function index (){
        $tasks = Tasks::all();
        $data = [
            'tasks' => $tasks,
            'status' => 200
        ];
        return response()->json($data,200);
    }
    
    public function crear (Request $request) {

        $validator = Validator::make($request->all(), [
            'title'=> 'required|min:3|max:100',
            'status'=> 'required',
            'priority'=> 'required',
            'due_date'=> 'required'
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
         return response()->json($data,400);   
        }

        $tasks = Tasks::create([
                        'title'=> $request->title,
                        'descripcion'=>$request->descripcion,
                        'status'=>$request->status,
                        'priority'=>$request->priority,
                        'due_date'=>$request->due_date
                    ]);
        
        if(!$tasks){
            $data = [
                'message' => 'Error al crear la tarea',
                'status' => 500
            ];
            return response()->json($data,500);
        };
        
        $data = [
            'tasks'=> $tasks,
            'status' => 201
        ];

        return response()->json($data,201);
        
    }

    public function mostrar($id){
         $tasks = Tasks::find($id);

       if(!$tasks) {
            $data = [
                'message' => 'El task no se encontro',
                'status' => 404
            ];
            return response()->json($data,404);
       }

       $data = [
                'message' => $tasks,
                'status' => 200
            ];

        return response()->json($data,200);
    }

    public function eliminar($id){

       $tasks = Tasks::find($id);

       if(!$tasks) {
            $data = [
                'message' => 'El task no se encontro',
                'status' => 404
            ];
            return response()->json($data,404);
       }

       $tasks->delete();

       $data = [
                'message' => 'El task fue eliminado',
                'status' => 200
            ];

        return response()->json($data,200);

    }

    public function actualizar(Request $request, $id){
         $tasks = Tasks::find($id);

        if(!$tasks) {
                $data = [
                    'message' => 'El task no se encontro',
                    'status' => 404
                ];
                return response()->json($data,404);
        }

       $validator = Validator::make($request->all(), [
                'title'=> 'required|min:3|max:100',
                'status'=> 'required',
                'priority'=> 'required',
                'due_date'=> 'required'
            ]);
        
        if($validator->fails()){
           $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
         return response()->json($data,400);  
        }

        $tasks->title= $request->title;
        $tasks->descripcion= $request->descripcion;
        $tasks->status=$request->status;
        $tasks->priority=$request->priority;
        $tasks->due_date=$request->due_date;

        $tasks->save();

        $data = [
                'message' => 'Datos actualizados',
                'tasks' => $tasks,
                'status' => 200
            ];
         return response()->json($data,200);  
    }
}
