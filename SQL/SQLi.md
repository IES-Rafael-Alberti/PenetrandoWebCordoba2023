# Inyección SQL

## **¿Que es eso de Inyección SQL?**

La inyección SQL (SQLi) es una vulnerabilidad de seguridad web que permite a un atacante interferir con las consultas que una aplicación realiza a su base de datos. 

Por lo general, permite que un atacante vea datos que normalmente no puede recuperar. Esto puede incluir datos pertenecientes a otros usuarios o cualquier otro dato al que la propia aplicación pueda acceder. 

En muchos casos, un atacante puede modificar o eliminar estos datos, provocando cambios persistentes en el contenido o el comportamiento de la aplicación.

En algunas situaciones, un atacante puede escalar un ataque de inyección SQL para comprometer el servidor subyacente u otra infraestructura de back-end, o realizar un ataque de denegación de servicio.


## **Bueno, ¿que pasaría si se logra hacer de forma exitosa?**
Un ataque de inyección SQL exitoso puede dar como resultado el acceso no autorizado a datos confidenciales, como contraseñas, detalles de tarjetas de crédito o información personal del usuario. Muchas violaciones de datos de alto perfil en los últimos años han sido el resultado de ataques de inyección SQL, lo que ha provocado daños a la reputación y multas reglamentarias. En algunos casos, un atacante puede obtener una puerta trasera persistente en los sistemas de una organización, lo que lleva a un compromiso a largo plazo que puede pasar desapercibido durante un período prolongado.

## **Ejemplos**
Existe una amplia variedad de vulnerabilidades, ataques y técnicas de inyección SQL, que surgen en diferentes situaciones. Algunos ejemplos comunes de inyección SQL incluyen:

### **Recuperación de datos ocultos**
 Donde puede modificar una consulta SQL para obtener resultados adicionales.

### **Subvertir la lógica de la aplicación**
 Donde puede cambiar una consulta para interferir con la lógica de la aplicación.
### **Ataques UNION** 
 Donde puede recuperar datos de diferentes tablas de bases de datos.
### **Examinar la base de datos**
 Donde se puede extraer información sobre la versión y estructura de la base de datos.
### **Inyección ciega de SQL.**
 Donde los resultados de una consulta que usted controla no se devuelven en las respuestas de la aplicación.

 ## **Cómo detectar vulnerabilidades de inyección SQL**
La mayoría de las vulnerabilidades de inyección SQL se pueden encontrar de manera rápida y confiable utilizando el escáner de vulnerabilidades web de Burp Suite .

La inyección SQL se puede detectar manualmente mediante el uso de un conjunto sistemático de pruebas contra cada punto de entrada en la aplicación. Esto típicamente involucra:

Enviar el carácter de comillas simples 'y buscar errores u otras anomalías.
Enviar alguna sintaxis específica de SQL que evalúe el valor base (original) del punto de entrada y un valor diferente, y buscar diferencias sistemáticas en las respuestas de la aplicación resultante.
Enviar condiciones booleanas como OR 1=1y OR 1=2, y buscar diferencias en las respuestas de la aplicación.
Enviar cargas útiles diseñadas para desencadenar retrasos de tiempo cuando se ejecutan dentro de una consulta SQL y buscar diferencias en el tiempo necesario para responder.
Enviar cargas útiles de OAST diseñadas para desencadenar una interacción de red fuera de banda cuando se ejecutan dentro de una consulta SQL y monitorear las interacciones resultantes.


## **Cómo prevenir la inyección SQL**
La mayoría de las instancias de inyección SQL se pueden evitar mediante el uso de consultas parametrizadas (también conocidas como declaraciones preparadas) en lugar de la concatenación de cadenas dentro de la consulta.

El siguiente código es vulnerable a la inyección SQL porque la entrada del usuario se concatena directamente en la consulta:
```
String query = "SELECT * FROM products WHERE category = '"+ input + "'";

Statement statement = connection.createStatement();
ResultSet resultSet = statement.executeQuery(query);
```
Este código se puede reescribir fácilmente de manera que evite que la entrada del usuario interfiera con la estructura de la consulta:
```
PreparedStatement statement = connection.prepareStatement("SELECT * FROM products WHERE category = ?");
statement.setString(1, input);
ResultSet resultSet = statement.executeQuery();
```
Las consultas parametrizadas se pueden usar para cualquier situación en la que la entrada que no sea de confianza aparezca como datos dentro de la consulta, incluida la WHEREcláusula y los valores en una instrucción INSERTo . UPDATENo se pueden usar para manejar entradas que no sean de confianza en otras partes de la consulta, como nombres de tablas o columnas, o la ORDER BYcláusula. La funcionalidad de la aplicación que coloca datos que no son de confianza en esas partes de la consulta deberá adoptar un enfoque diferente, como incluir en la lista blanca los valores de entrada permitidos o usar una lógica diferente para ofrecer el comportamiento requerido.

Para que una consulta parametrizada sea efectiva en la prevención de la inyección SQL, la cadena que se usa en la consulta siempre debe ser una constante codificada y nunca debe contener datos variables de ningún origen. No caiga en la tentación de decidir caso por caso si un elemento de datos es confiable y continúe usando la concatenación de cadenas dentro de la consulta para los casos que se consideren seguros. Es demasiado fácil cometer errores sobre el posible origen de los datos, o que los cambios en otro código violen las suposiciones sobre qué datos están contaminados.


## **Para mas información**
Estos enlaces contienen información útil sobre la vulnerabilidad de **inyección SQLi**
>- [CheatSheetSQLi](https://portswigger.net/web-security/sql-injection/cheat-sheet)
>- [Prevención sqli por parte de OWASP](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html)
>- [Guía universal OWASP](https://owasp.org/www-pdf-archive/Gu%C3%ADa_de_pruebas_de_OWASP_ver_3.0.pdf)
>- [Testing SQLi](https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/07-Input_Validation_Testing/05-Testing_for_SQL_Injection)
>- [Más información y laboratorios](https://portswigger.net/web-security/sql-injection)
