# Arranque del proyecto

## Instalación

Abrimos la CMD o terminal en el directorio raiz del proyecto y ejecutamos los siguientes comandos:
```
composer install
copy .env.example .env
php artisan key:generate
npm install
npm run dev
```

## Arrancar el servidor

Debemos abrir una terminal en el directorio raíz del proyecto.

Ejecutamos: 
```
php artisan serve
```

¡Listo!, la página debería estar corriendo en http://127.0.0.1:8000
