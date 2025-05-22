<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLogsCreate;
use App\Models\ApiLog;

class ApiLogController extends Controller
{
    public function index()
    {
        try{
            $logs = ApiLog::all()->map(function ($log) {
                $data = is_array($log->data) ? $log->data : (is_iterable($log->data) ? iterator_to_array($log->data) : []);                $log->data = array_slice($data, 0, 2);
             return $log;
            });

        return response()->json($logs);
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }

    }

    public function store(ApiLogsCreate $request)
    {
        try {
            $dataRequest = $request->validated();
            $log = ApiLog::create($dataRequest);
            return response()->json($log, 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }

    }

    public function destroy($id)
    {
        try{
           $log= ApiLog::findOrFail($id);
           if(!$log){
               return response()->json(['Error'=>'No se encuentra el registro'],404);
           }
           $log->delete();
           return response()->json('Registro Eliminado',200);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }
    public function update(ApiLogsCreate $request,$id)
    {
        try {
            $log = ApiLog::findOrFail($id);
            if(!$log){
                return response()->json(['Error'=>'No se encuentra el registro'],404);
            }
            $dataRequest = $request->validated();
            ApiLog::updated($id);
            return response()->json($dataRequest,200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }

    }


    public function destroyAll()
    {
        try {
            ApiLog::truncate();

            return response()->json([
                'message' => 'Todos los registros fueron eliminados correctamente.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar los registros.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
