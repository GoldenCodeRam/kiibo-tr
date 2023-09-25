<p align="center"><img src="https://github.com/GoldenCodeRam/kiibo-tr/blob/main/public/img/logo.svg" width="250" alt="Project Logo"></p>

# Project Log

Este es un proyecto creado como respuesta a una prueba técnica como desarrollador Frontend y Backend para la empresa Kiibo. Las generalidades del proyecto se encuentran a continuación:

El proyecto es generado como una aplicación Full-Stack, generada con el framework web de [Laravel](https://laravel.com/), la cual cuenta con tres (3) partes importantes, generadas a respuesta de una serie de enunciados requeridos para la correcta ejecución del proyecto;
> - Crear un servicio web, que permita a los usuarios autorizados la gestión de sus tareas:
Consultar, Crear, Modificar, Borrar. (Ver Servicios Web Disponibles e Interface Gráfica)
>  - Crear las pruebas unitarias para comprobar el correcto funcionamiento de los métodos
ofrecidos por el servicio
>  - Documentar el servicio utilizando una herramienta tipo Swagger.
    Publicar el código en un repositorio de GitHub. Para la revisión y evaluación

Como se puede observar, se requiere una aplicación que posea un portal web para la visualización del proyecto, un servicio para almacenar y controlar usuarios y sus registros, y una base de datos para el almacenamiento de los datos. El desarrollo de cada uno de estos puntos se describe a continuación.

## Servicio Web

Como se expone con anterioridad, el servicio web es creado con el framework web de [Laravel](https://laravel.com/), junto con una base de datos relacional, usando el motor de bases de datos [MySQL](https://www.mysql.com/). El modelo relacional usado para la base de datos se muestra a continuación:

<p align="center">
    <img src="https://github.com/GoldenCodeRam/kiibo-tr/assets/46252493/2c760f0d-9072-4882-b552-01a57f200f34">
    <br>
    Imagen 1: Modelo relacional simplificado usado para el proyecto.
</p>

Para la creación de la base de datos y una subida de datos de prueba, se hizo uso de las migraciones y el proceso de _seeding_, ofrecido por el framework de [Laravel](https://laravel.com/).

Para la interfaz web se hizo uso del framework de [Inertia.js](https://inertiajs.com/), junto con el framework de JavaScript [Vue.js](https://vuejs.org/). Las demás dependencias, tanto del servicio web, como de la interfaz web, se pueden encontrar en sus respectivos archivos.

### Ejecución del Servicio Web

Para la ejecución del proyecto se hizo uso del sistema de contenedores y virtualización [Docker](https://www.docker.com/). Y sus pasos generales se enuncian a continuación:

Para iniciar la base de datos para un entorno de desarrollo local:
```bash
docker compose up
```

Para iniciar el servicio web en un entorno de desarrollo local:
```bash
# Clonar el proyecto.
git clone https://github.com/GoldenCodeRam/kiibo-tr
cd kiibo-tr

# Instalar dependencias
composer install

# Generar archivo de variables de entorno
cp .env.example .env
# Generar llave para el proyecto
php artisan key:generate

# Generar base de datos y migraciones
php artisan migrate --seed
# Seeder para las tareas de prueba
php artisan db:seed LogSeeder

# Iniciar proyecto en modo de desarrollo
php artisan serve
```

Para iniciar la interfaz web en un entorno de desarrollo local:
```bash
# Instalar dependencias
npm install

# Iniciar proyecto en modo de desarrollo
npm run dev
```

Una vez se haya creado la base de datos, el servicio web y la interfaz, el proyecto estará funcionando correctamente.

## Pruebas Unitarias

Las pruebas unitarias y de funcionalidad se hicieron a través del framework web de [Laravel](https://laravel.com/). Éstas se pueden ejecutar de manera sencilla, haciendo uso del comando:
```bash
php artisan test
```

## Documentación

Para la documentación, se hizo uso de la librería de [Swagger](https://swagger.io/) para [Laravel](https://laravel.com/); [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger). Y su despliegue se puede encontrar en la ruta: `api/documentation` del servicio web.
