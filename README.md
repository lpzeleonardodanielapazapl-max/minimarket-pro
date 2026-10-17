#  Sistema de Microservicios - Minimarket PRO-413

Este proyecto implementa una arquitectura basada en microservicios para la gestión de productos de un minimarket. La solución permite consultar, registrar, editar y eliminar lógicamente productos mediante una interfaz web, garantizando la separación de responsabilidades entre el frontend, el backend y la base de datos.

##  Arquitectura del Sistema

El sistema está compuesto por tres servicios independientes.

Frontend: Aplicación web desarrollada en Laravel (PHP). Se comunica exclusivamente mediante peticiones HTTP con la API REST. No tiene conexión directa a la base de datos.

Backend: API REST desarrollada con Quarkus (Java) y Hibernate ORM con Panache. Maneja la lógica de negocio y las validaciones.

Base de Datos: Contenedor Docker con MySQL 8.0. Utiliza un script de inicialización para crear la tabla Producto.

- Tecnologías Utilizadas
Backend: Java , Quarkus, Hibernate ORM (Panache), Maven.

Frontend: PHP , Laravel, Blade, Tailwind CSS (vía CDN).

Base de Datos: MySQL 8.0, Docker, Docker Compose.

- Requisitos Previos
Antes de ejecutar el proyecto, asegúrate de tener instalado:

Docker y Docker Compose

Java  (JDK)

PHP 8.1+ y Composer

- Instrucciones de Ejecución
Sigue estos pasos en orden para levantar el sistema completo:

1. Configurar Variables de Entorno
Por seguridad, las credenciales no se suben al repositorio.

En la raíz del proyecto, copia el archivo .env.example y renómbralo a .env.

En la carpeta frontend/, copia el archivo .env.example y renómbralo a .env.
(Asegúrate de que el archivo frontend/.env contenga la línea API_BACKEND_URL=http://localhost:8080/api).

2. Levantar la Base de Datos (MySQL)
Desde la raíz del proyecto, ejecuta:

bash
docker compose up -d
Nota: El contenedor expone MySQL en el puerto 3307 de tu máquina local (para evitar conflictos con instalaciones previas de MySQL) y mapea al 3306 interno. El script 01-schema.sql creará la tabla Producto automáticamente.

3. Levantar el Backend (Quarkus)
Abre una nueva terminal y ejecuta:

bash
cd backend-productos
En Linux/Mac/WSL:

bash
./mvnw quarkus:dev
En Windows (CMD/PowerShell):

powershell
.\mvnw.cmd quarkus:dev
La API estará escuchando en http://localhost:8080.

4. Levantar el Frontend (Laravel)
Abre una nueva terminal y ejecuta:

bash
cd frontend
composer install
php artisan key:generate
php artisan serve
Abre tu navegador e ingresa a http://127.0.0.1:8000.

🔌 Documentación de la API REST
El backend expone los siguientes endpoints:

Método	Ruta	Descripción
GET	/api/productos	Obtiene todos los productos activos (eliminado = 0).
GET	/api/productos/{id}	Obtiene un producto específico por su ID.
POST	/api/productos	Crea un nuevo producto (Validación de datos).
PUT	/api/productos/{id}	Actualiza los datos de un producto existente.
DELETE	/api/productos/{id}	Eliminación lógica: Cambia el estado del producto a eliminado = 1 sin borrarlo físicamente.
Ejemplo de JSON para crear/editar un producto:
json
{
  "nombre": "Leche Gloria 1L",
  "proveedor": "Gloria",
  "fechaVencimiento": "2026-12-31",
  "precio": 4.50,
  "stock": 50
}
