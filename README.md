# Request System

Sistema de gestion de solicitudes por roles construido con Laravel 12. Incluye un area publica para usuarios finales y un dashboard para administradores y jefes. Los permisos se aplican con Spatie roles y policies de rutas.

## Funcionalidades
- Area publica para el rol `user` (listar, ver, crear, editar y eliminar sus propias solicitudes).
- Dashboard para los roles `admin` y `boss`.
- Gestion de usuarios y tags solo para `admin`.
- `boss` puede ver todas las solicitudes y cambiar solo el estado.
- Listo para 2FA via Fortify (configurable).
- UI localizada con selector de idioma.

## Roles y reglas de acceso
- `user`
	- Area publica de solicitudes (`/requests`).
	- Puede crear, ver, editar y eliminar solo sus solicitudes.
	- Redirige a `/requests` despues de login.
- `boss`
	- Acceso al dashboard (`/dashboard`).
	- Puede ver todas las solicitudes y actualizar solo `status_id`.
	- Sin acceso a gestion de usuarios o tags.
- `admin`
	- Acceso completo al dashboard.
	- Gestiona usuarios, tags y todas las solicitudes (incluido estado).
	- Redirige a `/dashboard` despues de login.

## Stack tecnico
- Laravel 12
- PHP 8.2
- Spatie Laravel Permission (roles/permisos)
- Laravel Fortify (auth)
- Componentes Livewire/Flux en la UI (basados en plantillas)

## Estructura del proyecto (zonas clave)
- [app/Http/Controllers](app/Http/Controllers)
- [app/Http/Responses/LoginResponse.php](app/Http/Responses/LoginResponse.php)
- [app/Providers/FortifyServiceProvider.php](app/Providers/FortifyServiceProvider.php)
- [routes/web.php](routes/web.php) (rutas publicas)
- [routes/dashboard.php](routes/dashboard.php) (rutas dashboard)
- [resources/views](resources/views)
- [database/seeders/RoleSeeder.php](database/seeders/RoleSeeder.php)

## Instalacion
1) Instalar dependencias PHP
```bash
composer install
```

2) Instalar dependencias frontend
```bash
npm install
```

3) Crear archivo env
```bash
copy .env.example .env
```

4) Generar la key
```bash
php artisan key:generate
```

5) Migrar y poblar datos
```bash
php artisan migrate:fresh --seed
```

6) Levantar servidor local
```bash
php artisan serve
```

## Usuarios seed por defecto
Despues del seed, existen estas cuentas:
- Admin: `admin@admin.com` / `1234`
- Boss: `boss@boss.com` / `1234`
- User: `user@user.com` / `1234`

## Cache de permisos
Si cambias roles o permisos y no ves reflejo, limpia la cache:
```bash
php artisan permission:cache-reset
```

## Auth y redirecciones
Las redirecciones de login las maneja Fortify:
- `user` -> `/requests`
- `admin` and `boss` -> `/dashboard`

## Ciclo de solicitudes
- `user` puede crear solicitudes con titulo/descripción y tag opcional.
- El estado es: `pending`, `approved`, `rejected`.
- `boss` y `admin` pueden cambiar el estado desde el dashboard.

## Notas para desarrollo local
- La UI publica usa el layout `public`.
- El dashboard usa el layout `app`.
- Los alias de middleware de roles/permisos estan en [bootstrap/app.php](bootstrap/app.php).
