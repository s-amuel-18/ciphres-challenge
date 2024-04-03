# Prueba técnica

Prueba técnica e-commerce Laravel | Inertia.

## Primeros pasos

Descarga el repositorio del proyecto.

```bash
$ git clone https://github.com/s-amuel-18/ciphres-challenge.git
```

Descarga el repositorio del proyecto.

```bash
$ cp .env.example .env
```

Ingresa las credenciales de tu base de datos en postgreSQL

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ciphres_challenge
DB_USERNAME=postgres
DB_PASSWORD=password
```

Ejecuta el siguiente comando para instalción de dependencias.

```bash
$ composer install && npm install
```

Generar llave de acceso.

```bash
$ php artisan key:generate
```

Ejecuta las migraciones del proyecto.

```bash
$ php artisan migrate --seed
```

Inicializa el servidor backend

```bash
$ php artisan serve
```

Comando para ejecutar codigo del front

```bash
$ npm run dev
```

Si todo salió bien ya puedes usar la aplicación!!

## Credenciales de usuarios

Admin: test@example.com 11111111

Client: client@example.com 11111111
