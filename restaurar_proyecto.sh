#Clonar
git clone https://github.com/Cesar-Heberto-Amaya-Quintero/plantillawebadmin2022.git
#Navegar hacia la carpeta del proyecto
cd carpeta_proyecto
#Restaurar librerias de laravel
composer install
#Restablecer el .env (mac y linux)
#En windows quizas sea copy o xcopy
cp .env.example .env
#Hacer el symlink para el almacenamiento
php artisan storage:link
#Restuarar la BD desde el manejador de BD
#Corremos el server de prueba
php artisan serve
