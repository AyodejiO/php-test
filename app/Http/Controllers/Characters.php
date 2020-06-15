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
        //
        $characters = null; // initialize all characters
        $info = null; // get pagination info

        // url params
        $params = [
            "page" => $request->input("page")?? 1,
            "name" => $request->input("name")?? null,
            "status" => $request->input("status")?? null,
        ];
        
        $response = Http::get('https://rickandmortyapi.com/api/character/', $params); // HTTP request response from API

        if($response->ok()) {
            //
            $info =  $response->json()["info"];
            $characters =  $response->json()["results"];

            $dummyCollection = collect(range(1, $info["count"]));
            $perPage = round($info["count"]/$info["pages"]);

            $page = $info["next"]? (int) Str::of($info["next"])->after('=')->__toString() : (int) Str::of($info["prev"])->after('=')->__toString();
            $num = $info["next"]? -1 : 1;

            $path = route("characters.index");
            $currentPage = $page + $num;

            $pager = new LengthAwarePaginator(
                collect($info["count"]), 
                $info["count"],
                $perPage, 
                $currentPage
            );

            $pager->withPath($path);
            return view("home", ["characters" => $characters, "pager" => $pager]);
        };

        return view("home", ["characters" => "Some error occurred", "pager" => null]);
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

        if($response->ok()) {
            //
            $character =  $response->json();
            return view("single", ["character" => $character]);
        };
        
        return view("home", ["characters" => $character]);
    }
}
