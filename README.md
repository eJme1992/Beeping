<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2>Instalación de dependencias PHP:</h2>
<ul>
  <li>Ejecuta <code>composer install</code> para instalar las dependencias PHP del proyecto.</li>
</ul>

<h2>Instalación de Redis local:</h2>
<ol>
  <li>Instala Redis localmente siguiendo las instrucciones en <a href="https://redis.io/docs/">redis.io/docs</a>.</li>
  <li>Instala la extensión de PHP para Redis utilizando <code>pecl install redis</code>.</li>
  <li>Verifica que la extensión <code>redis.so</code> esté activa en el archivo <code>php.ini</code>.</li>
</ol>

<h2>Dependencias de Front-end:</h2>
<ol>
  <li>Ejecuta <code>npm install</code> para instalar las dependencias de front-end.</li>
  <li>Instala Vite globalmente utilizando <code>npm install -g vite</code>.</li>
  <li>Asegúrate de tener Node.js versión 20.11.0 instalada.</li>
</ol>

<h2>Configuración del archivo .env de Laravel:</h2>
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
DB_DATABASE=Beeping
DB_USERNAME=root
DB_PASSWORD=
</pre>

<h2>Seed de la Base de Datos:</h2>
<p>Ejecuta los siguientes comandos para sembrar la base de datos:</p>
<pre>
php artisan db:seed --class=OrdersSeeder
php artisan db:seed --class=ProductsSeeder
php artisan db:seed --class=OrderLinesTableSeeder
</pre>

<h2>Ejecución del Schedule Worker:</h2>
<p>Inicia el worker de schedule ejecutando <code>php artisan schedule:work</code>.</p>