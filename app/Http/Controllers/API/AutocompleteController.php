<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request) {
        
        $palabraabuscar = $request->get('palabraabuscar');
        
        $Productos = Product::where('nombre','like','%'.$palabraabuscar .'%')->orderBy('nombre')
        ->get();

        $resultados=[];

        foreach ($Productos as $prod) {

            $encontrartexto =  stristr($prod->nombre, $palabraabuscar);
            $prod->encontrar = $encontrartexto;

            $recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));
            $prod->substr = $recortar_palabra;

            $prod->name_negrita =  str_ireplace($palabraabuscar, "<b>$recortar_palabra</b>",$prod->nombre);

            $resultados[] = $prod; 
        } 

        
        return  $resultados;
    }
}
