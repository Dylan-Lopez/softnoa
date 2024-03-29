# Instalación

## Requisitos

- Instalar php
- Instalar composer
- Tener una base de datos

## Configuración

Modificar el archivo .env con los datos de conexión de la base de datos

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/softnoa"
```

Para instalar el proyecto

```
git clone https://gitlab.com/promani/elclick.git
cd soft_noa
composer install
```

Para correr la aplicación

```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update -f
symfony serve
```
php bin/console cache:pool:clear cache.global_clearer

