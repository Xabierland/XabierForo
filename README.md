# XabierForo

## DESCRIPCION

Proyecto simple de un foro online programado en **PHP** montado en un servidor **Apache** con una base de datos **MySQL** y el sistema de administracion de base de datos **phpMyAdmin**.

## INSTALACION

1. Instalar docker: <https://docs.docker.com/desktop/>
2. Iniciar servicios mediante: `docker compose up`
3. Accede mediante una shell al contenedor de la base de datos. `docker exec -it [docker_db_container_name] bash`
4. Importa la base de datos mediante `mysql -uroot -proot foro<database.sql`

## USO

* Iniciar servicios mediante: `docker compose up`
* Cerrar sercivios mediante: `docker compose down`

## FAQ

* ¿Donde esta mi servidor Apache?

> El servidor Apache se aloja en el puerto 80

* ¿Donde se aloja el servidor phpMyAdmin?

> El servidor phpMyAdmin se aloja en el puerto 8080

* ¿Cuales son las credenciales de phpMyAdmin?

> Las credenciales son: `admin` - `admin`

* ¿Como puedo crear categorias?

> Tienes que tener una cuenta de administrador, para esto, accede mediante phpMyAdmin y crea o edita una cuenta para tener un `user_level = 1`

* ¿Porque una base de datos MySQL?

> Lo escogi por la sencilles de MySQL aunque cualquiera de sus forks e incluso otras bases de datos deberian de funcionar bien ya que he usado **PDO**
