# Users - Delete

**DELETE** */users/{id}*

## Parâmetros da URL

* **id**: Identificador único do usuário a ser excluído.
  * Tipo: *integer*
  * Exemplo: `1`

### Request Exemplo
```http
DELETE http://191.252.204.173/api/users/1 HTTP/1.1
```

## Response (204)

### Retorno

**Status Code**: 204 No Content

```http
HTTP/1.1 204 No Content
```

**Nota**: O retorno é um status 204 (sem conteúdo), indicando que a operação foi bem-sucedida, mas não há conteúdo a ser retornado.
