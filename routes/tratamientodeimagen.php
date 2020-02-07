<?php



//0 saber si un usuario o producto tiene o no una imagen
$usuario = App\User::find(1);

$image= $usuario->image;

if ($image) {
    echo 'tiene una imagen';
}
else {
    echo 'no tiene una imagen';
}

return $image;


//01 crear una imagen para un usuario utilizando el metodo save

$imagen = new App\Image(['url'=> 'imagenes/avatar.png']);

$usuario = App\User::find(1);

$usuario->image()->save($imagen);

return $usuario;


//02 obtener las informaciones de las imagenes a traves del usuario

$usuario = App\User::find(1);

return $usuario->image->url;



//03 crear varias imagenes para un producto utilizando el metodo savemany

$producto = App\Product::find(3);

$producto->images()->saveMany([
    new App\Image(['url'=> 'imagenes/avatar.png']),
    new App\Image(['url'=> 'imagenes/avatar2.png']),
    new App\Image(['url'=> 'imagenes/avatar3.png']),


]);

return $producto->images;




//04 crear una imagen para un usuario utilizando el metodo create

$usuario = App\User::find(1);

$usuario->image()->create([
    'url' => 'imagenes/avatar2.png',
]);

return $usuario;


// otra forma seria asi

$imagen = [];

$imagen['url'] = 'imagenes/avatar3.png';

$usuario = App\User::find(1);

$usuario->image()->create( $imagen );

return $usuario;


//05 crear varias imagenes para un producto utilizando el metodo createmany

$imagen = [];

$imagen[]['url'] = 'imagenes/avatar.png';
$imagen[]['url'] = 'imagenes/avatar2.png';
$imagen[]['url'] = 'imagenes/avatar3.png';
$imagen[]['url'] = 'imagenes/a.png';
$imagen[]['url'] = 'imagenes/a.png';
$imagen[]['url'] = 'imagenes/a.png';

$producto = App\Product::find(2);

$producto->images()->createMany($imagen);

return $producto->images;



    //06 actualizar la imagen del usuario.

    $usuario = App\User::find(1);

    $usuario->image->url='imagenes/avatar2.png';
    
    $usuario->push();

    return $usuario->image;



   //07 actualizar la imagen de los productos

    $producto = App\Product::find(3);

    $producto->images[0]->url='imagenes/a.png';
    $producto->push();

    return $producto->images;

        //08 buscar el registro relacionado en la imagen

        $image = App\Image::find(7);

        return $image->imageable;
    

 //09 delimitar los registros

 $producto = App\Product::find(2);

 return $producto->images()->where('url','imagenes/a.png')->get();



 //10 ordenar registros que provienen de la relacion.

    $producto = App\Product::find(2);

    return $producto->images()->where('url','imagenes/a.png')->orderBy('id','Desc')->get();

  //11 contar los registros relacionados
   
  $usuario = App\User::withCount('image')->get();
  $usuario= $usuario->find(1);
  return $usuario->image_count;



  //12 contar los registros relacionados a los productos
   
  $productos = App\Product::withCount('images')->get();
  $productos= $productos->find(2);
  return $productos->images_count;

     //13 contar los registros relacionados a los productos de otra forma
   
     $productos = App\Product::find(2);
     return $productos->loadCount('images');



//14 lazy loading carga diferida

$producto = App\Product::find(3);

$imagen = $producto->image;

$categoria = $producto->category;


//15 carga previa (eager loading() 

 $usuario = App\User::with('image')->get();

 return $usuario;


//16 carga previa (eager loading() 
    
$producto = App\Product::with('images')->get();

return $producto;


 //17 carga previa de multiples relaciones
 $producto = App\Product::with('images','category')->get();

 return $producto;
 
     //18 carga previa de multiples relaciones de un producto especifico
     $producto = App\Product::with('images','category')->find(3);

     return $producto;


   //19 delimitar los campos.
   $producto = App\Product::with('images:id,imageable_id,url','category:id,nombre,slug')->find(3);

   return $producto;    



    //20 eliminar una image

    $product = App\Product::find(2);
    $product->images[0]->delete();
    return $product;
    
 //21 eliminar todas las imagenes

 $product = App\Product::find(2);
 $product->images()->delete();
 return $product;


