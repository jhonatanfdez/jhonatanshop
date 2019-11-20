# jhonatanshop

Bienvenidos al proyecto "jhonatanshop". 

Este es un proyecto de una tienda online hecho en Laravel 6.

Para poder utilizar este proyecto, debes tener los siguientes requisitos:

1) debes tener la versión de PHP mayor o igual a la 7.2.0. 
para mas información visita la documentación oficial de Laravel: https://laravel.com/docs/6.x

2) debes tener instalado composer en tu equipo: https://getcomposer.org/

3) si utilizas windows, puedes descargar el programa git desde la página oficial: https://gitforwindows.org/

Si cumples con estos prerequisitos, entonces podrás instalar este proyecto.

Pasos para instalar este proyecto correctamente:

1) descarga este proyecto o clónalo con el comando: 

git clone git://github.com/schacon/grit.git

2) ejecutar el comando: 

composer install

3) copiar el archivo ".env.example" y pegarlo con el nombre: ".env". Si estas con el sistema gitforwindows, o en linux o mac, puedes ejecutar el siguiente comando: 

cp .env.example .env

4) debemos generar una nueva llave de laravel con el siguiente comando:

php artisan key:generate

5) Configura la nueva base de datos modificando el archivo ".env":

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jhonatanshop
DB_USERNAME=Jhonatanfdez
DB_PASSWORD=123456

6) ejecuta php artisan migrate

7) ejecuta php artisan serve y prueba el proyecto que debe funcionar.

Un saludo y Dios les bendiga a todos. 
