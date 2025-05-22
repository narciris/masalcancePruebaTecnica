<?php

namespace App\Services;

use App\Events\ApiRequest;
use Illuminate\Support\Facades\Http;

class ExternalApiService
{
    private  string $BASE_URL;

    public function __construct ()
    {
        $this->BASE_URL = config('services.external_api.base_url');
    }

    public function getUsers()
    {
        try {
            $endpoint = '/users';
            $res = Http::get($this->BASE_URL . $endpoint);
            $data  = $res->json();
            event(new ApiRequest('GET',($data)));
            return $data;
        } catch (\Exception $e) {
            return  response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getPost()
    {
        $endpoint = '/posts';
        $res = Http::get($this->BASE_URL . $endpoint);
        $data  = $res->json();
        event(new ApiRequest('GET',($data)));
        return $data;
    }

    public function getPostById($id)
    {
        $endpoint = '/posts/' . $id;
        $res = Http::get($this->BASE_URL . $endpoint);
        $data  = $res->json();
        event(new ApiRequest('GET',($data)));
        return $data;
    }

    public function getPostByUserId($id)
    {
        $endpoint = '/users/' . $id . '/posts';
        $res = Http::get($this->BASE_URL . $endpoint);
        $data  = $res->json();
        event(new ApiRequest('GET',($data)));
        return $data;
    }

    public function getAlbums($id)
    {
        $endpoint = '/users/'  . $id . '/albums';
        $res = Http::get($this->BASE_URL . $endpoint);
        $data  = $res->json();
        event(new ApiRequest('GET',($data)));
        return $data;

    }




}
