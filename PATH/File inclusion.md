# Local file inclusion

## ¿Que es?

Este tipo de ataques tiene como objetivo Acceder a archivos y directorios almacenados fuera de la raíz web. Mediante la manipulación de variables que hacen referencia a archivos con "(.. /)" secuenciados y  variaciones o mediante el uso de rutas de archivo absolutas, puede ser posible acceder a archivos arbitrarios y directorios almacenados en el sistema de archivos, incluido el código fuente de la aplicación o Configuración y archivos críticos del sistema. Cabe señalar que el acceso a archivos está limitado por el control de acceso operativo del sistema

Lo primero que tenemos que tener claro son las diferencias entre un Local File Inclusión y un Path traversal ya que a simple vista pueden parecer lo mismo.

Básicamente, la diferencia es que con una vulnerabilidad de Local file inclusion, el recurso se carga y **ejecuta** en el contexto de la aplicación actual. Una vulnerabilidad de Path traversal, por otro lado, solo ofrece la capacidad de leer el recurso.

Es por ello que podemos utilizar un local file inclusión aprovechándonos de una vulnerabilidad como es el File Upload para poder conseguir acceso a la maquina o listar archivos sensibles.

## ¿Que impacto puede tener?

El impacto de la vulnerabilidad de un Local File inclusión dependera finalmente de si consigue o no realizar una ejecución remota de comandos.

Un atacante puede conseguir extraer información de la maquina con acciones como estas:

```
https://inseguro.com/loadImage?filename=../../../etc/passwd
```

Lo que puede suceder con esto es que el servidor entienda la siguiente ruta de archivo por lo que nos muestre finalmente la información que estamos buscando.

```
/var/www/*/../../../etc/passwd = /etc/passwd
```

