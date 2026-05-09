# 💼 MiNegocioApp

MiNegocioApp es una plataforma en desarrollo pensada para emprendedores y pequeñas empresas que desean gestionar y promocionar sus negocios en línea de forma sencilla, con una interfaz moderna, femenina y elegante.

El proyecto centraliza la administración de productos, negocios, usuarios y ventas desde un mismo sistema, con roles diferenciados para Administrador, Emprendedor y Cliente.

---

## 🚀 Estado del proyecto

MVP Funcional – El proyecto se encuentra en una versión mínima viable operativa.

Características implementadas:
- Sistema de autenticación con roles (Admin, Emprendedor, Cliente)
- Panel de administración con gestión de usuarios
- Panel de emprendedor con CRUD de negocios y productos
- Panel de cliente con catálogo de productos
- Diseño unificado con estética femenina moderna
- Carga y visualización de imágenes para productos
- Filtros y búsqueda en catálogos

Próximas etapas:
- Módulo de pedidos y carrito de compras
- Dashboard con estadísticas avanzadas
- Integración con pasarelas de pago
- Notificaciones en tiempo real

---

## 🎨 Diseño y Estilos

La plataforma cuenta con una identidad visual femenina, moderna y elegante:

Paleta de colores: Gradientes púrpura (#7C3AED) y rosa (#F472B6)
Fondos: Gradientes suaves (#FDF4FF, #FCF7FF, #FFF7FB)
Efectos: Glassmorphism, bordes suaves, sombras elegantes
Tipografía: Figtree (moderna y legible)
Iconografía: SVG personalizados para cada sección

---

## 🧰 Tecnologías utilizadas

Laravel 10.x - Framework backend
PHP 8.2+ - Lenguaje backend
Blade - Motor de plantillas
Tailwind CSS 3.x - Estilos y componentes
MySQL 5.7+ - Base de datos
Laravel Breeze - Autenticación
Git & GitHub - Control de versiones

---

## ⚙️ Instalación y configuración

Requisitos previos:
- PHP 8.2 o superior
- Composer
- Node.js y NPM
- MySQL

Pasos:
git clone https://github.com/softhamck/minegocioapp.git
cd minegocioapp
composer install
npm install
cp .env.example .env
php artisan key:generate

Configura tu base de datos en .env

php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
php artisan serve

En otra terminal:
npm run dev

Accede en:
http://127.0.0.1:8000

Credenciales:
Administrador: admin@minegocioapp.com / password
Emprendedor: emprendedor@minegocioapp.com / password
Cliente: cliente@minegocioapp.com / password

---

## 📁 Estructura del proyecto

minegocioapp/
app/
resources/
routes/
database/
public/
storage/

---

## 🗺️ Plan de desarrollo

Etapa 1 - MVP (Completado)
Etapa 2 - Funcionalidades avanzadas (En desarrollo)
Etapa 3 - Escalamiento (Futuro)

---

## 👥 Roles del sistema

Administrador: Gestión total
Emprendedor: Gestión de negocios y productos
Cliente: Compra y visualización

---

## 🤝 Contribuciones

Fork -> Rama -> Commit -> Push -> Pull Request

---

## 📞 Contacto

Desarrolladora: Andrea Cano
GitHub: @softhamck

Desarrolladora: Juliana Herrera
GitHub: @julianaherrera1

---

## 📝 Licencia

Licencia MIT
