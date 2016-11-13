<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        return view('index');
    }

    public function create(Request $request)
    {

        $result = array();
        $cinemaId = $request->cinemaId;
        $filmId = $request->filmId;
        

        $re = array('cinemaId' => $cinemaId, 'filmId' => $filmId);
        try {
            $result['state'] = 200;
            $result['content'] = json_encode($re);
        } catch (\Exception $e) {
            $result ['state'] = 0;
            $result ['error'] = json_encode($e);
        }

        return $result;
    }





}
