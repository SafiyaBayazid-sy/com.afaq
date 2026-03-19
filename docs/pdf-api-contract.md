# PDF Mobile API Contract

This document tracks the endpoints requested in `api.pdf` and the implementation now available in this Laravel project.

## Implemented Base Paths

- `POST /api/auth/register`
- `POST /api/auth/login`
- `GET /api/projects`
- `POST /api/inspections/store`
- `POST /api/consultations/store`
- `GET /api/orders`
- `GET /api/orders/{id}`

These routes were added as a compatibility layer for the PDF contract and live alongside the existing versioned customer API under `/api/v1/...`.

## Notes

- The original `/api/v1/...` customer API remains unchanged for current consumers.
- The PDF-compatible routes use the field names requested by the document, such as `full_name`, `authorized_person`, `consultation_type`, and `question`.
- Authentication for protected PDF-compatible routes uses Sanctum bearer tokens.
- Registration accepts the PDF source values `social_media`, `friends`, `ads`, and `other`, then maps them to the existing internal customer source enum.

## Response Shape

All compatibility endpoints follow the shared JSON envelope used in the project:

```json
{
  "success": true,
  "message": "...",
  "data": {}
}
```

Validation errors return:

```json
{
  "success": false,
  "message": "...",
  "errors": {
    "field": ["..."]
  }
}
```

## Orders Design

The PDF describes request submission plus an orders list/details flow. To support that cleanly without breaking the existing booking/inquiry API, the project now stores PDF-compatible requests in a dedicated `service_orders` table.

Current order types:

- `inspection`
- `consultation`

The orders list returns the simplified card data required by the PDF:

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Engineering inspection request",
      "status": "pending",
      "status_text": "Pending"
    }
  ]
}
```

The order details endpoint returns the timeline-oriented shape requested by the mobile document, with nullable fields where the order type does not use them.
