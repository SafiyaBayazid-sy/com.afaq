# AFAQ Customer API Quickstart

This guide helps the mobile team start using the customer API with Postman.

## Files

- OpenAPI spec: `docs/api.json`
- Postman collection: `docs/postman-customer-api-collection.json`
- Postman environment: `docs/postman-customer-api-environment.json`
- PDF contract notes: `docs/pdf-api-contract.md`

## Import Into Postman

1. Open Postman.
2. Import `docs/postman-customer-api-collection.json`.
3. Import `docs/postman-customer-api-environment.json`.
4. Select the `AFAQ Customer API - Local` environment.
5. Use `docs/api.json` if you also want the raw OpenAPI spec.

## Environment Variables

- `base_url`: app host, for example `http://127.0.0.1:8000`
- `api_base_url`: API root, for example `http://127.0.0.1:8000/api/v1`
- `auth_token`: Bearer token returned by login/register
- `customer_email`: test customer email
- `customer_password`: test customer password
- `project_id`: sample project id for details endpoint
- `notification_id`: sample notification id for mark-as-read endpoint
- `device_token`: sample mobile push token
- `device_platform`: `android` or `ios`

## Base URL

Customer API root:

```text
{{api_base_url}}
```

Examples:

```text
{{api_base_url}}/auth/login
{{api_base_url}}/projects
{{api_base_url}}/my/profile
```

## PDF Compatibility Endpoints

The project now also exposes the unversioned endpoints requested in `api.pdf`:

```text
POST /api/auth/register
POST /api/auth/login
GET /api/projects
POST /api/inspections/store
POST /api/consultations/store
GET /api/orders
GET /api/orders/{id}
```

These routes are documented in `docs/pdf-api-contract.md` and are intended for clients that need to match the PDF field names and response shapes exactly.

## Authentication Flow

Protected endpoints use Sanctum bearer tokens.

Header:

```text
Authorization: Bearer {{auth_token}}
Accept: application/json
Content-Type: application/json
```

### Option 1: Register

Request:

```http
POST {{api_base_url}}/auth/register
Content-Type: application/json
Accept: application/json
```

Body:

```json
{
  "name": "Mobile Customer",
  "email": "api.customer@example.com",
  "password": "password123",
  "phone": "0500000000",
  "source": "other"
}
```

Save:

- `data.token` -> `auth_token`

### Option 2: Login

Request:

```http
POST {{api_base_url}}/auth/login
Content-Type: application/json
Accept: application/json
```

Body:

```json
{
  "email": "{{customer_email}}",
  "password": "{{customer_password}}"
}
```

Save:

- `data.token` -> `auth_token`

## Recommended First Requests

### Public Endpoints

- `GET {{api_base_url}}/projects`
- `GET {{api_base_url}}/projects/filters`
- `GET {{api_base_url}}/settings/public`
- `GET {{api_base_url}}/content/pages`

### Authenticated Endpoints

- `GET {{api_base_url}}/my/profile`
- `GET {{api_base_url}}/my/notifications`
- `POST {{api_base_url}}/my/device-tokens`
- `POST {{api_base_url}}/bookings`
- `POST {{api_base_url}}/inquiries`

## Example Authenticated Requests

### Register Push Device Token

```http
POST {{api_base_url}}/my/device-tokens
Authorization: Bearer {{auth_token}}
Content-Type: application/json
Accept: application/json
```

```json
{
  "token": "{{device_token}}",
  "platform": "{{device_platform}}",
  "device_name": "Pixel 8",
  "app_version": "1.0.0"
}
```

### Book Appointment

```http
POST {{api_base_url}}/bookings
Authorization: Bearer {{auth_token}}
Content-Type: application/json
Accept: application/json
```

```json
{
  "booking_date": "2026-03-25",
  "booking_time": "10:30",
  "notes": "Morning slot preferred"
}
```

### Submit Inquiry

```http
POST {{api_base_url}}/inquiries
Authorization: Bearer {{auth_token}}
Content-Type: application/json
Accept: application/json
```

```json
{
  "message": "I need more details about this project."
}
```

## Logout

```http
POST {{api_base_url}}/auth/logout
Authorization: Bearer {{auth_token}}
Accept: application/json
```

After logout, clear `auth_token` in Postman.

## Notes For The Mobile Team

- All successful responses use:

```json
{
  "success": true,
  "message": "...",
  "data": {}
}
```

- Validation failures return status `422`.
- Unauthorized requests return status `401`.
- Forbidden requests return status `403`.

## Refreshing The Docs

When backend endpoints change, regenerate the OpenAPI file with:

```powershell
composer docs:api
```

Then re-import `docs/api.json` in Postman if needed.

If you use the curated Postman collection, you can also keep using:

- `docs/postman-customer-api-collection.json`
- `docs/postman-customer-api-environment.json`
