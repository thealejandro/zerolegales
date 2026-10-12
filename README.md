# Zero Legales (Herramientas Legales)

Plataforma web en Laravel para la venta, llenado en línea y legalización de plantillas de documentos legales, comercializada bajo la marca "Herramientas Legales".

## Contexto

- Año: 2024 (intervención de mantenimiento). El código base es anterior: las migraciones datan de finales de 2020 y 2021.
- Este repositorio recoge el estado del sistema al momento del ajuste del controlador de precios (`Front\PriceController`). No es un desarrollo desde cero.
- Proyecto histórico, sin mantenimiento. Se conserva como registro de trabajo realizado.

## Funcionalidades observadas en el código

- Catálogo y búsqueda de plantillas de documentos legales por categoría y tipo.
- Registro e inicio de sesión de usuarios (correo, Google y Facebook vía Socialite), verificación por correo y recuperación de contraseña.
- Lista de precios, suscripciones y compra individual de documentos.
- Llenado de documentos a partir de variables/etiquetas de la plantilla y generación de PDF (dompdf).
- Carpetas personales del usuario ("Mis carpetas") e historial de compras.
- Legalización de documentos con enlace a un abogado y directorio de abogados.
- Pagos con Cybersource Secure Acceptance (VisaNet Guatemala).
- Panel de administración: categorías, plantillas, variables de entrada, matriz de precios, términos y condiciones, usuarios y reportes.
- Interfaz en español e inglés (`resources/lang`).

## Tecnologías

- PHP 7.2+ / 8, Laravel 6, MySQL.
- Blade, jQuery, Bootstrap 4, Laravel Mix.
- barryvdh/laravel-dompdf, laravel/socialite, laravelcollective/html, cybersource/rest-client-php.

## Cómo correrlo

Estructura estándar de Laravel:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Las credenciales de base de datos, correo, OAuth y Cybersource deben configurarse en `.env` y nunca versionarse.

## Estado

Proyecto histórico, sin mantenimiento. No incluye archivo de licencia propio.
