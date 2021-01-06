<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TestController extends Controller
{
    //
    public function index(){
        $collection = collect([1, 2, 3, 4, 5, 6, 7]);

        $chunks = $collection->chunk(4);
        
        $chunks->toArray();

        //dd($chunks);

        return view('tests.test', compact('collection'));
    }
}
