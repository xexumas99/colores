# Arranque del proyecto

## Instalación

Abrimos la CMD o terminal en el directorio raiz del proyecto y ejecutamos los siguientes comandos:
```
composer install
copy .env.example .env
php artisan key:generate
npm install
```

## Arrancar el servidor

Debemos tener abirtas dos terminales en el directorio raiz del proyecto.
En una ejecutamos: 
```
php artisan serve
```

En la otra:
```
npm run watch
```

¡Listo!, la página debería abrirse en http://127.0.0.1:8000
