<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2>Requerimientos Previos:</h2>
<ul>
  <li>Servidor Web y PHP: Se requiere Apache con PHP 8 o superior.</li>
  <li>Base de Datos: Se debe tener MySQL instalado y configurado correctamente.</li>
  <li>Creación de Base de Datos: Antes de continuar, asegúrate de crear una base de datos en MySQL.</li>
</ul>

<h2>Instalación de Dependencias PHP:</h2>
<ol>
  <li>Ejecuta el siguiente comando para instalar las dependencias PHP del proyecto:</li>
</ol>
<pre>
composer install
</pre>

<h2>Instalación de Redis Local:</h2>
<ol>
  <li>Sigue las instrucciones en <a href="https://redis.io/docs/">redis.io/docs</a> para instalar Redis localmente.</li>
  <li>Instala la extensión de PHP para Redis utilizando el siguiente comando:</li>
</ol>
<pre>
pecl install redis
</pre>
<p><b>Nota:</b> Durante la instalación en la consola, preguntará si instalar otra dependencia que no son estándar para PHP, responde "no" a todas las preguntas.</p>

<h2>Dependencias de Front-end:</h2>
<ol>
  <li>Ejecuta el siguiente comando para instalar las dependencias de front-end:</li>
</ol>
<pre>
npm install
</pre>
<ol start="2">
  <li>Instala Vite globalmente utilizando el siguiente comando:</li>
</ol>
<pre>
npm install -g vite
</pre>
<ol start="3">
  <li>Asegúrate de tener Node.js versión 20.11.0 instalada.</li>
</ol>

<h2>Configuración del Archivo .env de Laravel:</h2>
<p>En el archivo <code>.env</code> de Laravel, asegúrate de configurar las siguientes variables:</p>
<pre>
APP_URL=http://127.0.0.1:8000/
REDIS_CLIENT=xxxxx
REDIS_HOST=xxxx
REDIS_PASSWORD=xxx
REDIS_PORT=xxxx
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NombreDeTuBaseDeDatos
DB_USERNAME=root
DB_PASSWORD=
QUEUE_CONNECTION=redis
</pre>

<h2>Seed de la Base de Datos:</h2>
<ol>
  <li>Ejecuta el siguiente comando para migrar la base de datos:</li>
</ol>
<pre>
php artisan migrate
</pre>
<ol start="2">
  <li>Después, ejecuta los siguientes comandos para sembrar la base de datos:</li>
</ol>
<pre>
php artisan db:seed --class=OrdersSeeder
php artisan db:seed --class=ProductsSeeder
php artisan db:seed --class=OrderLinesTableSeeder
</pre>

<h2>Ejecución del Schedule Worker:</h2>
<ol>
  <li>Inicia el worker de schedule ejecutando el siguiente comando:</li>
</ol>
<pre>
php artisan horizon
</pre>
<ol start="2">
  <li>O, para ejecutar el worker de schedule, utiliza el siguiente comando:</li>
</ol>
<pre>
php artisan schedule:work
</pre>

<h2>Acceder al Servidor Virtual:</h2>
<ol>
  <li>Para acceder al servidor virtual, ejecuta el siguiente comando:</li>
</ol>
<pre>
php artisan serve
</pre>
<p><b>Nota:</b> Visita la raíz en tu navegador para empezar a usar el programa.</p>

<h2>Acceso a Horizon:</h2>
<p>Para acceder a Horizon, visita la siguiente URL en tu navegador:</p>
<a href="http://127.0.0.1:8000/horizon/dashboard">http://127.0.0.1:8000/horizon/dashboard</a>
