<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
       
        $productos = Product::with('images','category')->where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(2);
        return view('admin.product.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados_productos = $this->estados_productos();
        $categorias = Category::orderBy('nombre')->get();
        return view('admin.product.create',compact('categorias','estados_productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|unique:products,nombre',
            'slug' => 'required|unique:products,slug',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        
        $urlimagenes = [];

        if ($request->hasFile('imagenes')) {

            $imagenes = $request->file('imagenes');

            //dd ($imagenes);

            foreach ($imagenes as $imagen) {

                $nombre = time().'_'.$imagen->getClientOriginalName();

                $ruta = public_path().'/imagenes';
                
                $imagen->move($ruta , $nombre);

                $urlimagenes[]['url'] = '/imagenes/'.$nombre;


            }

            //return $urlimagenes;

        }


        
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


        $prod->images()->createMany($urlimagenes);

        //return $prod->images;

        return redirect()->route('admin.product.index')->with('datos','Registro creado correctamente!');

        
 
        //return $request->all();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $producto = Product::with('images','category')->where('slug',$slug)->firstOrFail();

        $categorias = Category::orderBy('nombre')->get();

        $estados_productos = $this->estados_productos();

        //dd($estados_productos);
        
        return view('admin.product.show',compact('producto','categorias','estados_productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $producto = Product::with('images','category')->where('slug',$slug)->firstOrFail();

        $categorias = Category::orderBy('nombre')->get();

        $estados_productos = $this->estados_productos();

        //dd($estados_productos);
        
        return view('admin.product.edit',compact('producto','categorias','estados_productos'));
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
        
        $request->validate([
            'nombre' => 'required|unique:products,nombre,'.$id,
            'slug' => 'required|unique:products,slug,'.$id,
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        
        $urlimagenes = [];

        if ($request->hasFile('imagenes')) {

            $imagenes = $request->file('imagenes');

            //dd ($imagenes);

            foreach ($imagenes as $imagen) {

                $nombre = time().'_'.$imagen->getClientOriginalName();

                $ruta = public_path().'/imagenes';
                
                $imagen->move($ruta , $nombre);

                $urlimagenes[]['url'] = '/imagenes/'.$nombre;


            }

            //return $urlimagenes;

        }


        
        $prod = Product::findOrFail($id);

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


        $prod->images()->createMany($urlimagenes);

        //return $prod->images;

        return redirect()->route('admin.product.edit',$prod->slug)->with('datos','Registro actualizado correctamente!');

        
 
        //return $request->all();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod= Product::with('images')->findOrFail($id);

        foreach($prod->images as $image) {
            
            $archivo = substr($image->url,1);

             File::delete($archivo);
    
            $image->delete();
        }

        //return $prod;
        $prod->delete();
        return redirect()->route('admin.product.index')->with('datos','Registro eliminado correctamente!');

    }


    public function estados_productos(){


        return [
            '',
            'Nuevo',
            'En Oferta',
            'Popular'
        ];
    }





}
