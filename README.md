
# 💼 MiNegocioApp

**MiNegocioApp** es una plataforma en desarrollo pensada para **emprendedores y pequeñas empresas** que desean **gestionar y promocionar sus negocios en línea** de forma sencilla.  
El proyecto busca centralizar la administración de productos, clientes, ventas y estadísticas desde un mismo sistema.

---

## 🚀 Estado del proyecto

> 🧱 **En desarrollo** – Se está construyendo la base del sistema con Laravel y Breeze.  
> Próximas etapas: implementación de roles, módulos de productos y panel de control.

---

## 🧰 Tecnologías utilizadas

- **Framework:** Laravel 10  
- **Lenguaje:** PHP 8.2
- **Frontend:** Blade + Tailwind CSS  
- **Base de datos:** MySQL  
- **Autenticación:** Laravel Breeze  
- **Entorno local:** XAMPP  
- **Control de versiones:** Git & GitHub  

---

## ⚙️ Instalación y configuración

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tuusuario/minegocioapp.git
   ```
2. Accede al proyecto:
   ```bash
   cd minegocioapp
   ```
3. Instala dependencias:
   ```bash
   composer install
   npm install
   ```
4. Crea y configura el archivo `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Configura la base de datos (MySQL) en el `.env` y ejecuta:
   ```bash
   php artisan migrate
   ```
6. Inicia el servidor:
   ```bash
   php artisan serve
   npm run dev
   ```

---

## 🧩 Estructura general (en construcción)
```
app/
 ├── Http/
 ├── Models/
 ├── Controllers/
resources/
 ├── views/
 ├── css/
 ├── js/
database/
 ├── migrations/
 ├── seeders/
```

---

## 🗺️ Plan de desarrollo

### Etapa 1 (actual)
- Configuración inicial con Laravel y Breeze  
- Autenticación de usuarios  
- Base de datos y migraciones  

### Etapa 2 (próxima)
- Implementación de roles (Admin, Emprendedor, Cliente)  
- Módulo de productos y categorías  

### Etapa 3 (futuro)
- Carrito de compras y gestión de ventas  
- Dashboard con estadísticas  
- Comunicación entre usuarios  
- Integración con pasarelas de pago  

---

<!-- ## 🤝 Contribuciones

Este proyecto se encuentra en fase temprana de desarrollo, pero se planea abrir a contribuciones una vez se establezca la estructura base. -->

---

## 📝 Licencia

Este proyecto se distribuye bajo la licencia MIT.  
Consulta el archivo `LICENSE` para más detalles.
