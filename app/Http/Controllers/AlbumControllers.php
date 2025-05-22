<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use Illuminate\Http\Request;

class AlbumControllers extends Controller
{
    public function __construct(private ExternalApiService $service)
    {

    }

    public function getAlbums( $id){
        try {
            $data = $this->service->getAlbums($id);
            return response()->json($data, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());
        }

    }
}
