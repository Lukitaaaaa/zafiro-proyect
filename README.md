<p align="center"><img  width="256" src="public/images/logo-zafiro.png"/></p>

# Zafiro Project

Zafiro Project es una red social que permite a los usuarios registrarse, iniciar sesión, crear publicaciones, y editar su perfil. Este proyecto está construido con Laravel, un framework de PHP y Bootstrap.

## Descripción

Zafiro Project es una aplicación web que proporciona una plataforma para que los usuarios compartan contenido y se conecten entre sí. Las características principales incluyen:

- Registro e inicio de sesión de usuarios.
- Creación, edición y eliminación de publicaciones.
- Edición de perfil de usuario, incluyendo la actualización y eliminación de la imagen de perfil.
- Visualización de publicaciones en un feed.

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu máquina local:

- `git clone https://github.com/Lukitaaaaa/zafiro-proyect.git`
- `cd zafiro-proyect`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan serve`

## Uso

Para usar la aplicación, abre tu navegador y navega a http://localhost:8000. Desde allí, puedes registrarte, iniciar sesión, crear publicaciones y editar tu perfil.

## Contribución

Si deseas contribuir al proyecto, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Agrega nueva funcionalidad'`).
4. Sube tus cambios a tu fork (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para obtener más información.

