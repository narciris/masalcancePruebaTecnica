<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLogsCreate;
use App\Models\ApiLog;
use Illuminate\Http\Request;

class ApiLogController extends Controller
{
    public function index()
    {
        try{
        $logs = ApiLog::all();
        return response()->json($logs);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function store(ApiLogsCreate $request)
    {
        try {
            $dataRequest = $request->validated();
            ApiLog::create($dataRequest);
        return response()->json($dataRequest,200);
        }catch (\Exception $exception){
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
            ApiLog::update($id,$dataRequest);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }

    }
}
