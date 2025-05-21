<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class ExternalApiController extends Controller
{

    private  $service;
    public function __construct (ExternalApiService $service)
    {
     $this->service = $service;
    }
    public function getPost()
    {
        try{
            $post = $this->service->getPost();
            return response()->json($post,200);
        }catch (\Exception $exception){
            return response()->json(["Error"=>$exception->getMessage()],400);
        }
    }

    public function getPostById($id)
    {
        try {
            $this->service->getPostById($id);
            return response()->json($this->service->getPostById($id),200);
        }catch (\Exception $exception){
            return response()->json(["Error"=>$exception->getMessage()],400);
        }
    }

    public function postByUserId($id)
    {
        try{
            $post = $this->service->getPostByUserId($id);
            return response()->json($post,200);
        } catch (\Exception $exception){
            return response()->json(["Error"=>$exception->getMessage()],400);
        }
    }
}
