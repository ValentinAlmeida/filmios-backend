# Users - Unblock Access

**PUT** */users/{id}/unblock*

## URL Param

* **id**: Identificador único do usuário.
  * Tipo: *integer*

## Request
```http
PUT http://191.252.204.173/api/users/1/unblock HTTP/1.1
Content-Type: application/json

{
  "id": 1
}
```

## Response (204)

```http
HTTP/1.1 No Content 204
```

## Tipagem no Response (204)

* **status**: Sem conteúdo no corpo da resposta, apenas o status 204.
