
# **Path Traversal**

## **¿Qué es el recorrido de directorios?**
El cruce de directorios (también conocido como Path Traversal) es una vulnerabilidad de seguridad web que permite a un atacante leer archivos arbitrarios en el servidor que ejecuta una aplicación. Esto podría incluir código y datos de la aplicación, credenciales para sistemas back-end y archivos confidenciales del sistema operativo. En algunos casos, un atacante podría escribir en archivos arbitrarios en el servidor, lo que le permitiría modificar los datos o el comportamiento de la aplicación y, en última instancia, tomar el control total del servidor.






## **Cómo prevenir un ataque transversal de directorio**
La forma más efectiva de prevenir las vulnerabilidades de cruce de rutas de archivos es evitar pasar la entrada proporcionada por el usuario a las API del sistema de archivos. Muchas funciones de aplicación que hacen esto se pueden reescribir para ofrecer el mismo comportamiento de una manera más segura.

Si se considera inevitable pasar la entrada proporcionada por el usuario a las API del sistema de archivos, se deben usar dos capas de defensa juntas para evitar ataques:

La aplicación debe validar la entrada del usuario antes de procesarla. Idealmente, la validación debería compararse con una lista blanca de valores permitidos. Si eso no es posible para la funcionalidad requerida, entonces la validación debe verificar que la entrada contenga solo contenido permitido, como caracteres puramente alfanuméricos.
Después de validar la entrada proporcionada, la aplicación debe agregar la entrada al directorio base y usar una API de sistema de archivos de plataforma para canonicalizar la ruta. Debe verificar que la ruta canónica comience con el directorio base esperado.
A continuación se muestra un ejemplo de un código Java simple para validar la ruta canónica de un archivo en función de la entrada del usuario:
```
    File file = new File(BASE_DIRECTORY, userInput);
    if (file.getCanonicalPath().startsWith(BASE_DIRECTORY)) {
    // process file
    }
```


## **Para mas información**
Estos enlaces contienen información útil sobre la vulnerabilidad de **path traversal**
>- [Testing PATH](https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/05-Authorization_Testing/01-Testing_Directory_Traversal_File_Include)
>- [PrevencionPath](https://owasp.org/www-community/attacks/Path_Traversal)
>- [Más información y laboratorios](https://portswigger.net/web-security/file-path-traversal)
