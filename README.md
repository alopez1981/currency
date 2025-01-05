# Currency Management API

## Descripción
La **Currency Management API** es una aplicación diseñada para gestionar tasas de cambio entre monedas, utilizando principios de arquitectura hexagonal, DDD (Domain-Driven Design) y CQRS (Command Query Responsibility Segregation). Esta API interactúa con la API externa Fixer para obtener tasas de cambio actualizadas y permite consultar conversiones, listar monedas disponibles y registrar el historial de cambios.

---

## **Características principales**

### Endpoints disponibles

1. **Listar monedas disponibles**
    - **Método:** `GET`
    - **URL:** `/api/currencies`
    - **Descripción:** Retorna una lista de monedas disponibles.
    - **Respuesta de ejemplo:**
      ```json
      [
          {"code": "USD", "name": "US Dollar"},
          {"code": "EUR", "name": "Euro"}
      ]
      ```

2. **Conversión de tasas de cambio**
    - **Método:** `POST`
    - **URL:** `/api/currencies/rate-conversion`
    - **Descripción:** Calcula la conversión entre dos monedas para una cantidad específica.
    - **Parámetros requeridos:**
      ```json
      {
          "from": "USD",
          "to": "EUR",
          "amount": 100
      }
      ```
    - **Respuesta de ejemplo:**
      ```json
      {
          "from": "USD",
          "to": "EUR",
          "amount": 100,
          "result": 85.00
      }
      ```

3. **Actualizar tasas de cambio**
    - **Método:** Interno (Command `UpdateRatesCommand`)
    - **Descripción:** Actualiza las tasas de cambio en la base de datos y registra el historial de cambios.

---

## **Tecnologías utilizadas**

- **Framework:** Laravel
- **API externa:** [Fixer API](https://fixer.io/)
- **Base de datos:** MySQL
- **Herramientas adicionales:**
    - Mailhog (para pruebas de envío de correos)
    - Git (para control de versiones)

---

## **Estructura del proyecto**

### Capas principales

1. **Dominio (Domain):**
    - Contiene las entidades y las interfaces de repositorios.

2. **Aplicación (Application):**
    - Contiene casos de uso, comandos, queries y sus handlers.

3. **Infraestructura (Infrastructure):**
    - Contiene las implementaciones de repositorios y adaptadores para servicios externos.

---

## **Cómo ejecutar el proyecto**

### Requisitos previos
- PHP 8.1+
- Composer
- MySQL
- Mailhog (para pruebas de correo)

### Pasos

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/alopez1981/currency.git
   cd tu-repositorio
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   ```

3. **Configurar el archivo `.env`:**
   ```env
   FIXER_API_KEY=tu_clave_de_api
   FIXER_API_URL=https://data.fixer.io/api/latest
   DB_DATABASE=currency_management
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   MAIL_HOST=mailhog
   MAIL_PORT=1025
   ```

4. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

5. **Ejecutar el servidor:**
   ```bash
   php artisan serve
   ```

6. **Iniciar Mailhog:**
   ```bash
   docker run -d -p 8025:8025 -p 1025:1025 mailhog/mailhog
   ```
    - Accede a Mailhog en: [http://localhost:8025](http://localhost:8025)

---

## **Pruebas**

### Pruebas unitarias
Ejecuta las pruebas unitarias usando PHPUnit:
```bash
php artisan test
```

### Pruebas de endpoints
- Usa herramientas como Postman o cURL para probar los endpoints de la API.

---

## **Contribuciones**

1. Crea una rama para tus cambios:
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
2. Realiza los cambios y sube la rama:
   ```bash
   git add .
   git commit -m "Descripción de los cambios"
   git push origin feature/nueva-funcionalidad
   ```
3. Abre un Pull Request en GitHub.

---

## **Licencia**
Este proyecto está bajo la licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).
