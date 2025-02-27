# Users - Modify State

**PUT** */users/{id}/modify-state*

## Parâmetros da URL

* **id**: Identificador único do usuário.
  * Tipo: *integer*
  * Exemplo: `1`

### Request Exemplo
```http
PUT http://191.252.204.173/api/users/1/modify-state HTTP/1.1
Content-Type: application/json
```

## Response (204)

A resposta para a modificação de estado do usuário não retorna conteúdo, apenas um status **204 No Content** indicando que a solicitação foi bem-sucedida.
