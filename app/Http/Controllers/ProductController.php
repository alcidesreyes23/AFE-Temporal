<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show()
    {
        $productos = ['PS4','PS5'];
        $productos2 = ['A','B','C','D'];        
        // return view('products/index')->with('productos',$productos);
        return view('products/index',compact('productos','productos2'));
    }
}
