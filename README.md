
# Challenge Broobe

Este proyecto permite obtener y guardar valores de distintas metricas de Google Speed como ser:
- ACCESSIBILITY
- BEST_PRACTICES 
- PERFORMANCE 
- PWA 
- SEO

## Puesta en marcha

- [Pasos](#Pasos)
- [](#)Poner disponible proyecto:
- 
  Desde la terminal, ingresar a carpeta destino de proyectos.
  
  git clone https://github.com/barriosjc/googlespeed.git
  
  cd googlespeed
  
  composer install
  
  cp .env_prod .env

- [](#)cree la ddbb:
  
  En MySQL ejecutar estos comandos.
  
  CREATE DATABASE googlespeed;
  
  use googlespeed;


- [](#)crear usuario y permisos:
- 
  CREATE USER 'broobe'@'localhost' IDENTIFIED BY 'broobe';
  
  GRANT ALL PRIVILEGES ON googlespeed.* TO 'broobe'@'localhost' WITH GRANT OPTION;

- [](#)FLUSH PRIVILEGES;

- [](#)Desde la terminal de Laravel.
- 
Ejecutar migraciones

php artisan migrate

Ejecutar seeders

php artisan db:seed

- [](#)listo para ejecute el proyecto.

- [Uso](#uso)
Al ingresar al sistema se ve un formulario con:
Un menu con 2 opciones para el ingreso de datos y listado.

Ingreso de datos

Es donde deberá ingresar y seleccionar los datos de:
Url (Debe incluir http:// o https://, dato obligatorio)
Categories (Seleccione las categorias de las que quiera obtener información, debe seleccionar por lo menos uno)
Strategy (Seleccione una estrategia, debe seleccionar uno)

- [](#)Luego haga click en -> Get Metrics
Luego de procesar el sistema mostrará las métricas seleccionadas y sus valores
Se habilita un botón que permite guardar las métricas.

- [](#)Listados
Puede ingresar ingresar o seleccionar datos a filtrar, todos los datos son opcionales.

