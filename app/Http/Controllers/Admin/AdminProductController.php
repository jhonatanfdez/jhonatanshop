<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
       
        $productos = Product::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(2);
        return view('admin.product.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::orderBy('nombre')->get();
        return view('admin.product.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $prod = new Product;

        $prod->nombre=                  $request->nombre;
        $prod->slug=                    $request->slug;
        $prod->category_id=             $request->category_id;
        $prod->cantidad=                $request->cantidad;
        $prod->precio_anterior=         $request->precioanterior;
        $prod->precio_actual=           $request->precioactual;
        $prod->porcentaje_descuento=    $request->porcentajededescuento;
        $prod->descripcion_corta=       $request->descripcion_corta;
        $prod->descripcion_larga=       $request->descripcion_larga;
        $prod->especificaciones=        $request->especificaciones;
        $prod->datos_de_interes=        $request->datos_de_interes;
        $prod->estado=                  $request->estado;


        if ($request->activo) {
            $prod->activo= 'Si';    
        }
        else {
            $prod->activo= 'No';    
        }



        if ($request->sliderprincipal) {
            $prod->sliderprincipal= 'Si';    
        }
        else {
            $prod->sliderprincipal= 'No';    
        }

    
        $prod->save();

        return $prod;
 
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
