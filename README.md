# 💼 MiNegocioApp

**MiNegocioApp** es una plataforma web desarrollada en Laravel para apoyar a emprendedores y pequeñas empresas en la gestión y promoción de sus negocios en línea.

El sistema permite administrar usuarios, negocios, productos, catálogos, carrito de compras y pedidos desde una misma aplicación, utilizando roles diferenciados para **Administrador**, **Emprendedor** y **Cliente**.

---

## 📌 Estado del proyecto

Actualmente el proyecto se encuentra en una etapa de **MVP funcional en desarrollo**.

### Funcionalidades implementadas

- Autenticación de usuarios con Laravel Breeze.
- Redirección automática según el rol del usuario.
- Panel para **Administrador**.
- Panel para **Emprendedor**.
- Panel para **Cliente**.
- Gestión de usuarios desde el rol administrador.
- Gestión de negocios para emprendedores.
- Gestión de productos asociados a negocios.
- Catálogo de productos para clientes.
- Visualización de detalle de productos.
- Módulo de carrito de compras.
- Creación y gestión inicial de pedidos.
- Carga y visualización de imágenes.
- Interfaz visual con estilo moderno, femenino y elegante.

---

## 👥 Roles del sistema

### Administrador

El administrador tiene acceso a la gestión general del sistema.

Funciones principales:

- Ver el dashboard administrativo.
- Gestionar usuarios.
- Gestionar productos.
- Revisar pedidos.
- Actualizar estado de pedidos.
- Eliminar registros cuando sea necesario.

### Emprendedor

El emprendedor puede administrar sus negocios y los productos asociados a ellos.

Funciones principales:

- Ver su dashboard.
- Crear, editar, visualizar y eliminar negocios.
- Crear, editar, visualizar y eliminar productos por negocio.
- Consultar productos.
- Consultar pedidos relacionados con su actividad.

### Cliente

El cliente puede navegar por el catálogo, revisar productos y realizar acciones de compra.

Funciones principales:

- Ver su dashboard.
- Explorar productos disponibles.
- Ver detalle de productos.
- Agregar productos al carrito.
- Actualizar cantidades del carrito.
- Eliminar productos del carrito.
- Vaciar el carrito.
- Crear pedidos.

---

## 🧩 Módulos principales

### Autenticación

El proyecto utiliza autenticación con Laravel Breeze.  
Después de iniciar sesión, el usuario es redirigido automáticamente a su panel correspondiente según su rol.

### Administración

Incluye funcionalidades para gestionar usuarios, productos y pedidos desde rutas protegidas por autenticación y rol de administrador.

### Emprendedores

Incluye la administración de negocios y productos.  
Los productos se gestionan dentro de cada negocio creado por el emprendedor.

### Clientes

Incluye catálogo de productos, detalle de productos, carrito de compras y creación de pedidos.

### Perfil de usuario

Cada usuario autenticado puede editar, actualizar o eliminar su perfil.

---

## 🎨 Diseño e interfaz

La plataforma maneja una identidad visual moderna, femenina y elegante.

Características visuales:

- Colores principales en tonos púrpura y rosa.
- Fondos suaves y gradientes.
- Tarjetas con bordes redondeados.
- Sombras sutiles.
- Diseño limpio y amigable.
- Uso de Blade y Tailwind CSS para las vistas.

---

## 🛠️ Tecnologías utilizadas

- **PHP 8.2+**
- **Laravel 12**
- **Laravel Breeze**
- **Blade**
- **Tailwind CSS**
- **Vite**
- **Alpine.js**
- **MySQL**
- **Composer**
- **Node.js y NPM**
- **Git y GitHub**

---

## 📁 Estructura general del proyecto

```text
minegocioapp/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Admin/
│           ├── Cliente/
│           └── Emprendedor/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── auth.php
├── storage/
├── tests/
├── composer.json
├── package.json
└── README.md
```

---

## ⚙️ Instalación y configuración

### 1. Clonar el repositorio

```bash
git clone https://github.com/softhamck/minegocioapp.git
```

### 2. Entrar a la carpeta del proyecto

```bash
cd minegocioapp
```

### 3. Instalar dependencias de PHP

```bash
composer install
```

### 4. Instalar dependencias de Node.js

```bash
npm install
```

### 5. Crear el archivo de entorno

```bash
cp .env.example .env
```

### 6. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 7. Configurar la base de datos

En el archivo `.env`, configura los datos de conexión a MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minegocioapp
DB_USERNAME=root
DB_PASSWORD=
```

> Ajusta `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` según tu configuración local.

### 8. Ejecutar migraciones

```bash
php artisan migrate
```

### 9. Ejecutar seeders

```bash
php artisan db:seed
```

### 10. Crear el enlace simbólico para almacenamiento

```bash
php artisan storage:link
```

### 11. Compilar assets

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

### 12. Iniciar el servidor local

```bash
php artisan serve
```

Luego abre el proyecto en el navegador:

```text
http://127.0.0.1:8000
```

---

## 🔐 Credenciales de prueba

Si los seeders del proyecto crean usuarios de prueba, se pueden usar credenciales como las siguientes:

| Rol | Correo | Contraseña |
| --- | --- | --- |
| Administrador | admin@minegocioapp.com | password |
| Emprendedor | emprendedor@minegocioapp.com | password |
| Cliente | cliente@minegocioapp.com | password |

> Si estas credenciales no funcionan, revisa los seeders ubicados en `database/seeders`.

---

## 🧭 Rutas principales

### Rutas públicas

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/` | Página de bienvenida |
| GET | `/dashboard` | Redirección principal por rol |
| GET | `/redirect-role` | Redirige al panel según el rol |

### Perfil

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/profile` | Editar perfil |
| PATCH | `/profile` | Actualizar perfil |
| DELETE | `/profile` | Eliminar perfil |

### Administrador

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/admin/dashboard` | Dashboard administrador |
| GET | `/admin/users` | Listar usuarios |
| GET | `/admin/users/create` | Crear usuario |
| POST | `/admin/users` | Guardar usuario |
| GET | `/admin/users/{user}/edit` | Editar usuario |
| PUT | `/admin/users/{user}` | Actualizar usuario |
| DELETE | `/admin/users/{user}` | Eliminar usuario |
| GET | `/admin/products` | Listar productos |
| GET | `/admin/products/{product}/edit` | Editar producto |
| PUT | `/admin/products/{product}` | Actualizar producto |
| DELETE | `/admin/products/{product}` | Eliminar producto |
| GET | `/admin/orders` | Listar pedidos |
| GET | `/admin/orders/{order}` | Ver pedido |
| PATCH | `/admin/orders/{order}/status` | Actualizar estado del pedido |
| DELETE | `/admin/orders/{order}` | Eliminar pedido |

### Emprendedor

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/emprendedor/dashboard` | Dashboard emprendedor |
| GET | `/emprendedor/products` | Ver productos |
| GET | `/emprendedor/business` | Listar negocios |
| GET | `/emprendedor/business/create` | Crear negocio |
| POST | `/emprendedor/business` | Guardar negocio |
| GET | `/emprendedor/business/{business}` | Ver negocio |
| GET | `/emprendedor/business/{business}/edit` | Editar negocio |
| PUT | `/emprendedor/business/{business}` | Actualizar negocio |
| DELETE | `/emprendedor/business/{business}` | Eliminar negocio |
| GET | `/emprendedor/orders` | Ver pedidos del emprendedor |

### Productos por negocio

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/emprendedor/business/{business}/products` | Listar productos del negocio |
| GET | `/emprendedor/business/{business}/products/create` | Crear producto |
| POST | `/emprendedor/business/{business}/products` | Guardar producto |
| GET | `/emprendedor/business/{business}/products/{product}/edit` | Editar producto |
| PUT | `/emprendedor/business/{business}/products/{product}` | Actualizar producto |
| DELETE | `/emprendedor/business/{business}/products/{product}` | Eliminar producto |

### Cliente

| Método | Ruta | Descripción |
| --- | --- | --- |
| GET | `/cliente/dashboard` | Dashboard cliente |
| GET | `/cliente/productos` | Catálogo de productos |
| GET | `/cliente/productos/{product}` | Detalle de producto |
| GET | `/cliente/carrito` | Ver carrito |
| POST | `/cliente/carrito/{productId}/add` | Agregar producto al carrito |
| PATCH | `/cliente/carrito/{productId}/update` | Actualizar cantidad |
| DELETE | `/cliente/carrito/{productId}/remove` | Eliminar producto del carrito |
| DELETE | `/cliente/carrito/clear` | Vaciar carrito |

---

## 🧪 Pruebas

Para ejecutar las pruebas del proyecto:

```bash
php artisan test
```

También puedes usar el script definido por Composer:

```bash
composer test
```

---

## 🚧 Próximas mejoras

- Completar flujo de pedidos.
- Mejorar dashboard con estadísticas.
- Agregar reportes para administradores y emprendedores.
- Implementar pasarela de pagos.
- Agregar notificaciones.
- Mejorar filtros de búsqueda en catálogos.
- Optimizar validaciones y mensajes al usuario.
- Mejorar documentación técnica del proyecto.

---

## 🤝 Contribución

Para contribuir al proyecto:

1. Haz un fork del repositorio.
2. Crea una nueva rama.

```bash
git checkout -b feature/nueva-funcionalidad
```

3. Realiza tus cambios.
4. Guarda los cambios con un commit.

```bash
git commit -m "Agrega nueva funcionalidad"
```

5. Sube la rama.

```bash
git push origin feature/nueva-funcionalidad
```

6. Abre un Pull Request.

---

## 👩‍💻 Autoras

- **Andrea Cano**  
  GitHub: [@softhamck](https://github.com/softhamck)

- **Juliana Herrera**  
  GitHub: [@julianaherrera1](https://github.com/julianaherrera1)

---

## 📄 Licencia

Este proyecto se distribuye bajo la licencia **MIT**.
