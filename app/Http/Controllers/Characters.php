<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class Characters extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // url params
        $params = [
            "page" => $request->input("page")?? 1,
            "name" => $request->input("name")?? null,
            "status" => $request->input("status")?? null,
        ];
        
        $response = Http::get('https://rickandmortyapi.com/api/character/', $params); // HTTP request response from API

        if($response->ok()) {
            //
            $info =  $response->json()["info"]; // reuqest meta
            $arr =  $response->json()["results"]; // request data

            $page = $info["next"]? (int) Str::of($info["next"])->after('=')->__toString() : (int) Str::of($info["prev"])->after('=')->__toString(); // get next or prev page
            $num = $info["next"]? -1 : 1; // number to get current page

            $pager = new LengthAwarePaginator(
                $arr, 
                $info["count"], //total
                count($arr), //perPage
                $page + $num, //currentPage
            );

            $pager->withPath(route("characters.index")); // set pagination path
            return view("home", ["pager" => $pager]);
        };

        return view("home", ["error" => "Some error occurred, please try again later!!!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function show($character)
    {
        //

        $response = Http::get('https://rickandmortyapi.com/api/character/'.$character);

        if(!$response->ok()) {
            //
            $character =  $response->json();
            return view("single", ["character" => $character]);
        };
        
        return view("single", ["error" => "Some error occurred, please try again later!!!"]);
    }
}
