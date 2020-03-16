<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request){
        $palabraabuscar = $request->get('palabraabuscar');
        
        $productos = Product::where('nombre','like','%'.$palabraabuscar.'%')->orderBy('nombre')->get();
        
        $nuevoresultado= [];

        foreach ($productos as $prod){
            $encontrartexto = stristr($prod->nombre,  $palabraabuscar);
            $recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));

            $prod->encontrar =  $encontrartexto;
            $prod->substr = $recortar_palabra;
            $prod->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_palabra</b>",$prod->nombre);
            $nuevoresultado[] = $prod;
        }

        return response()->json($nuevoresultado);
    }
}
