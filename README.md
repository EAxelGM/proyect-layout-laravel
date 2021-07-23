# LAYOUT
Este layout fue creado de la manera que ya tengas login, recuperar password, cambiar password, editar tu perfil con imagn, para que solo puedas comenzar a crear tu contenido.

recuerda hacer los siguientes paso

```bash
# copiar el proyecto
$ git clone https://github.com/EAxelGM/proyect-layout-laravel.git

# eliminar las dependencias remotas
$ git remote remove origin

# agrega el proyecto a tu git (para esto debes tener ya un repositorio creado)
$ git init
$ git remote add origin (URL DE TU REPOSITORIO)
$ git add .
$ git commit -m "copy"
$ git git branch -M master
$ git push -u origin master

```

## Una vez finalizado el copiado

```bash
# instala las dependencias
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan jwt:secret

# Ejecuta el proyecto -> localhost:8000
$ php artisan serve


```

## No olvides igual clonar el <a href="https://github.com/EAxelGM/proyect-layout-nuxtjs" target="_blank">front-end</a>
