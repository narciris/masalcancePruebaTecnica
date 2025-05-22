
Este proyecto consiste en consumir datos desde la API pública de JSONPlaceholder utilizando Laravel, registrar cada consumo como un log en una base de datos y permitir gestionar dichos registros (crear, editar, eliminar y listar).

Se implementó un servicio HTTP personalizado para realizar peticiones HTTP externas desde Laravel y registrar cada interacción en una tabla `api_logs`. También se implementó un sistema básico de manejo de errores y rutas API RESTful.

---

## Endpoints Disponibles

### Obtener Usuarios

```
GET /api/users
```

Obtiene una lista de usuarios desde JSONPlaceholder.

### Obtener Logs

```
GET /api/logs
```

Lista todos los logs almacenados en la base de datos.

### Obtener Publicaciones

```
GET /api/post
```

Obtiene una lista de publicaciones.

### Obtener Publicación por ID

```
GET /api/posts/{id}
```

Ejemplo:

```
GET /api/posts/5
```

### Crear un Log

```
POST /api/logs
```

Body de ejemplo:

```json
{
  "method": "POST",
  "data": [
    {"user_id": 1, "name": "Gregorio"}
  ]
}
```

### Editar un Log

```
PATCH /api/logs/{id}
```

Ejemplo:

```json
{
  "method": "DELETE",
  "data": [
    {"user_id": 1, "name": "Gregorio"}
  ]
}
```

### Borrar un Log

```
DELETE /api/logs/{id}
```

### Obtener Publicaciones por User ID

```
GET /api/posts/user/{id}
```

### Obtener Álbumes por ID de Usuario

```
GET /api/user/{id}/albums
```

---

## Uso del Cliente HTTP en Laravel

Laravel proporciona la clase `Http` que forma parte de Laravel HTTP Client, introducido en Laravel 7+. Esta clase permite realizar solicitudes externas de manera limpia y manejable.

### ¿Por qué usamos `Http`?

* Sintaxis sencilla y fluida.
* Manejo elegante de respuestas.
* Soporte para pruebas.
* Integración nativa con Laravel.

Ejemplo de uso:

```php
$response = Http::get('https://jsonplaceholder.typicode.com/posts');
```

Este cliente fue encapsulado en un **servicio personalizado** que se inyecta en los controladores para facilitar el mantenimiento y pruebas.

---

## Manejo de Errores

Todas las peticiones externas están protegidas con `try-catch` para capturar errores y devolver respuestas amigables en caso de fallos de conexión u otros errores.

Ejemplo:

```php
try {
  $response = Http::get($url);
} catch (Exception $e) {
  return response()->json(['error' => $e->getMessage()], 500);
}
```

---

## Rutas API

Las rutas de esta aplicación están definidas en el archivo `routes/api.php`, utilizando los métodos HTTP apropiados (`GET`, `POST`, `PATCH`, `DELETE`).

Ejemplo:

```php
Route::get('/logs', [LogController::class, 'index']);
```

---

## Migración de la Tabla `api_logs`

Se creó una migración para la tabla `api_logs`, que incluye los siguientes campos:

```php
Schema::create('api_logs', function (Blueprint $table) {
  $table->id();
  $table->string('method');
  $table->json('data');
  $table->timestamp('date')->useCurrent();
  $table->timestamps();
});
```

* `method`: método HTTP utilizado (`GET`, `POST`, etc.)
* `data`: datos enviados o recibidos
* `date`: fecha y hora de la acción
* `timestamps`: incluye `created_at` y `updated_at`

---

## Conclusión

Este proyecto integra buenas prácticas en el consumo de servicios externos con Laravel, persistencia de logs para auditoría, y un enfoque limpio usando servicios, controladores y migraciones. La elección del cliente `Http` permite una gestión eficiente y clara de las solicitudes externas, con manejo de errores y trazabilidad a través de los registros almacenados.
