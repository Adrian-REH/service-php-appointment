# API Appointment
## Descripcion
Comunicacion de Appointment con el servidor

### Lenguajes
[![php](https://img.shields.io/badge/php-F7DF1E?style=flat-square&logo=php&logoColor=black&labelColor=F7DF1E)]()
[![MySQL](https://img.shields.io/badge/MySQL-279FDF?style=flat-square&logo=mysql&logoColor=white&labelColor=279FDF)]()
</br>
   
### Diagrama de base de datos
![Diagram](https://github.com/Adrian-REH/APIappointment/blob/main/Diagrama%20sin%20título-Page-1.drawio.png)

### Diagrama de API

![Diagram](https://github.com/Adrian-REH/APIappointment/blob/main/Diagrama%20sin%20título-Página-2.drawio.png)
### Detalle
 - Buscar en APP "Nombre de Cliente" se relaciona y enlista los cliente_id.
 - Buscar en APP "Nombre de Profesional" se relaciona y enlista los profesional_id.
 - Buscar en APP "Odontograma" se busca en tabla archivo que odonotograma_id no este vacia y enlista los turnos_id busca el JSON de turno_id para busca el JSON de cliente_id para llena los cardview.
 - Buscar en APP "Formulario" se busca en tabla archivo que formulario_id no este vacia y enlista las valores formulario_id y busca los datos de cliente_id para llenar los cardview.
 - Buscar en APP "Recetas" se busca en tabla archivo que recetas no este vacio y enlista los turnos_id busca el JSON turno_id para buscar el JSON de cliente_id para llenar la cardview.
 - Buscar en APP "Laboratorio" se busca en tabla archivo que laboratiorio no este vacio y enlista los turnos_id busca el JSON turno_id para buscar el JSON de cliente_id para llenar la cardView
 - Buscar en APP "Estudios" se busca en tabla archivo que estudios no este vacio y enliste los turnos_id busca el JSON turno_id para buscar el JSON de cliente_id para llenar el cardview.
 - Buscar en APP "Turnos" busca en tabla archivo y enliste los turnos_id busca el JSON turno id_ para buscar el JSON de cliente_id para llenar el cardView
 - Selecciono en APP "Card Turno" se relaciona con el Turno_id se comunica con la API pidiendo a la BD el JSON del turno_id y el JSON archivo_id
 - Selecciono en APP "Card Profesional Favorito" se relaciona con Profesional_id se comunica con la API pidiendo a la BD el JSON profesional_id
 - Selecciono en APP "Card Profesional" se relaciona con Profesional_id se comunica con la API pidiendo a la BD el JSON profesional_id
 - Selecciono en APP "Card formulario" se relaciona con el formulario_id se comunica con la API pidiendo a la BD el JSON formulario_id

