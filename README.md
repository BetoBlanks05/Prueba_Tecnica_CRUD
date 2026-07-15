# CRUD de Catálogo de Productos

Este proyecto es un CRUD completo para un catálogo de productos en Laravel, usando Blade + Bootstrap 5 y MySQL.

## Características

- Modelo `Product` con campos: `id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`
- Migración para crear la tabla `products`
- Factory y seeder para generar 20 productos de prueba
- Controlador de recursos `ProductController`
- Rutas definidas con `Route::resource('products', ProductController::class)`
- Validación con Form Requests:
  - `StoreProductRequest`
  - `UpdateProductRequest`
- Frontend con Bootstrap 5 y vistas Blade:
  - `products.index`
  - `products.create`
  - `products.edit`
  - `products.show`

## Requisitos

- **Para Docker:** Docker Desktop y Docker Compose
- **Para Local:** PHP 8.3, Composer, MySQL

## Configuración e Instalación

### Opción 1: Con Docker

1. Tener Docker Desktop instalado y ejecutandose.

2. Clona el proyecto (o navega al directorio):

```bash
cd C:\laragon\www\CRUD-PruebaTecnica
```

3. Levanta los contenedores:

```powershell
docker-compose up -d
```

Esperar 1 o 2 minutos a que los contenedores se inicien.

4. Ejecuta las migraciones y el seed de los datos:

```powershell
docker-compose exec app php artisan migrate --seed
```

5. Accede a la aplicación:

```
http://localhost/products
```

Comandos:

```powershell
# Ver logs
docker-compose logs -f app

# Ejecutar comando artisan
docker-compose exec app php artisan [comando]

# Detener contenedores
docker-compose down

# Reiniciar
docker-compose up -d
```

---

### Opción 2: Instalación Local

1. Copia el archivo de entorno:

```bash
cp .env.example .env
```

2. Ajusta las credenciales de MySQL en `.env`:

```
DB_HOST=127.0.0.1
DB_DATABASE=crud
DB_USERNAME=user
DB_PASSWORD=password
```

3. Instala dependencias:

```bash
composer install
```

4. Genera la clave de la aplicación:

```bash
php artisan key:generate
```

5. Crea la base de datos en MySQL:

```bash
mysql -u root -p200999 -e "CREATE DATABASE IF NOT EXISTS crud;"
```

6. Ejecuta las migraciones y siembra:

```bash
php artisan migrate --seed
```

7. Levanta el servidor:

```bash
php artisan serve
```

Accede a `http://localhost:8000/products`

## Uso

- Listado de productos: `GET /products`
- Nuevo producto: `GET /products/create`
- Ver producto: `GET /products/{product}`
- Editar producto: `GET /products/{product}/edit`
- Eliminar producto: `DELETE /products/{product}`

## Archivos importantes

- `app/Models/Product.php`
- `database/migrations/2026_07_14_000000_create_products_table.php`
- `database/factories/ProductFactory.php`
- `database/seeders/DatabaseSeeder.php`
- `app/Http/Controllers/ProductController.php`
- `app/Http/Requests/StoreProductRequest.php`
- `app/Http/Requests/UpdateProductRequest.php`
- `resources/views/layout.blade.php`
- `resources/views/products/index.blade.php`
- `resources/views/products/create.blade.php`
- `resources/views/products/edit.blade.php`
- `resources/views/products/show.blade.php`

## Notas

- El formulario valida que el nombre sea único, el precio sea positivo y el stock sea un entero mayor o igual a 0.
- El listado de productos incluye búsqueda y etiquetas de stock con colores.
- El borrado usa confirmación con modal de Bootstrap.
- Los precios se muestran en formato mexicano (MXN): 14,000.00

## Stack Tecnológico

- **PHP 8.3** con Apache en contenedor
- **MySQL 8.1** en contenedor
- **Laravel 13.8** framework
- **Bootstrap 5** para el frontend
- **Blade** como motor de templates

## Archivos Docker

- `Dockerfile`: Configuración de la imagen PHP/Apache
- `docker-compose.yml`: Orquestación de contenedores (app + MySQL)
- `.env`: Variables de entorno (configurado para Docker)
