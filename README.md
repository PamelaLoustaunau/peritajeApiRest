# DOCUMENTACION 
## 1. Introducción
  Esta Documentación lo guiará con los recursos de la Api y le mostrará cómo realizar diferentes consultas para que pueda aprovecharla al máximo.

  ----

## 2. Tema
  Creamos una base de datos, modelando la relación (1 a N), Aseguradora-Siniestro.
  
  Esta Api, permite a los peritos (administradores), gestionar los siniestros de diferentes aseguradoras. 
  
  Los usuarios podrán obtener, crear,         actualizar y eliminar     dichos recursos.
  Actualmente los recursos disponibles son:
  
- siniestros

----
    
## 3. Endpoints
Las respuestas devolverán datos en formato JSON
  ### 3.1 Obtener todos los siniestros
  **Método:** GET
  
  **Descripción:** Obtener todos los siniestros disponibles (con opciones de filtrado, orden y paginación de los mismos).
  
  **Ruta:**   `https://localhost/peritajeApiRest/api/siniestros`
  
### 3.2 Obtener un siniestro específico
  **Método:** GET
  
  **Descripción:** Obtener un siniestro agregando su id como parámetro.
  
  **Ruta:** `https://localhost/peritajeApiRest/api/siniestros/3`

### 3.3 Agregar un siniestro
  **Método:** POST
  
  **Descripción:** Agregar un nuevo registro proporcionando los datos en formato JSON en el cuerpo de la solicitud.
  (el id se genera automáticamente).
  
  **Datos Requeridos:**

  **"Fecha":** "2024-12-1",
  
  **"Tipo_Siniestro":** "Rotura Cristales ",
  
  **"Asegurado":** "Mariana Frias",
  
  **"ID_Aseguradora":** 5



   **Ruta:**   `https://localhost/peritajeApiRest/api/siniestros`



### 3.4 Borrar un siniestro
  **Método:** DELETE
  
  **Descripción:** Borrar un registro indicando su id como parámetro
  
  **Ruta:** `https://localhost/peritajeApiRest/api/siniestros/3`

### 3.5 Actualizar/Modificar un siniestro
  **Método:** PUT
  
  **Descripción:** Modificar un registro indicando su id, los datos a modificar se proporcionan en formato JSON en el cuerpo de la solicitud.
  
  **Datos que pueden modificarse:**
  
  **"Fecha":** "2024-12-1",
  
  **"Tipo_Siniestro":** "Rotura Cristales ",
  
  **"Asegurado":** "Mariana Frias",
  
  **"ID_Aseguradora":** 5


 **Ruta:** `https://localhost/peritajeApiRest/api/siniestros/3`

  ----

## 4. Filtrado
Se pueden utilizar filtros en la URL para incluir parámetros de consulta adicionales.

Agregar un ? seguido de los parametros por los que desea filtrar \<query> = \<value>

**Ejemplo:**

**Parámetros de filtrado disponibles:**

- **order:** Se utiliza para seleccionar el campo por el que se desea filtrar 
  - **Fecha:** https://localhost/peritajeApiRest/api/siniestros?order=fecha
  - **Tipo de Siniestro:** https://localhost/peritajeApiRest/api/siniestros?order=tipoSiniestro
  - **Asegurado:** https://localhost/peritajeApiRest/api/siniestros?order=asegurado
  - **ID_Aseguradora:** https://localhost/peritajeApiRest/api/siniestros?order=idAseguradora
    
  Se pueden realizar combinaciones de filtrado utilizando el oprador lógico **&** de la sigueinte manera
- **priority:** Se utiliza para seleccionar la manera en que se ordenarán los registros
    - **ASC:(ordenamiento ascendente)** https://localhost/peritajeApiRest/api/siniestros?order=fecha&priority=ASC
    - **DESC:(ordenamiento descendente)** https://localhost/peritajeApiRest/api/siniestros?order=fecha&priority=DESC
        
   

  ----
## 5. Paginación

Con el parámetro **page** se puede acceder a distintas páginas. Si no se especifica ninguna en particular, se mostrarán los registros en su totalidad.

 - **Ejemplo:** Para acceder a la página 2, se debe añadir **?page=2** al final de la URL.


También se puede elegir la cantidad de registros que se mostrarán por página, con el parámetro **quantity**

 - **Ejemplo:** Para mostrar de a 5 registros por página se debe añadir **?quantity=5** al final de la URL.

Si desea utilizar ambos filtros de paginación se concatenan con el operador lógico **&**

**Ruta:**  https://localhost/peritajeApiRest/api/siniestros?page=2&quantity=5

https://localhost/peritajeApiRest/api/siniestros?order=fecha&priority=ASC&page=1&quantity=3

---- 
## 6. Autenticación

Para poder realizar cambios específicos en los registros **(ABM)** se requerirá autenticación.

La misma podrá realizarse de la siguiente manera:

 **Método:** GET
  
  **Ruta:** https://localhost/peritajeApiRest/api/login

  En la sección **Auth** seleccionar la opción Basic.

  **Ingresar con:**

  - **Username**: `webadmin`  
  - **Password**: `admin`  

Como resultado con el código de respuesta **200 OK** se obtendrá el token JWT.

Deberá ser copiado (sin incluir las "") en la opción **Bearer**.
Luego en la sección **Headers**  completar el campo: 

  - header= Authorization
  - value= Bearer (token JWT)

(tildar el checkbox **Raw**).

En caso de ser incorrectas las credenciales, solamente se podrá acceder al listado de los recursos en su totalidad y de manera individual a cada uno de ellos.

----


## Integrantes

- María Soledad Cedro  solcedro82@gmail.com

- Pamela Loustaunau  pamelitaloustaunau@gmail.com




