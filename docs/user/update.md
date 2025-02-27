# Users - Update

**PUT** */users/logged*

### Request Exemplo
```http
PUT http://191.252.204.173/api/users/logged HTTP/1.1
Content-Type: application/json

{
    "login": "newlogin",
    "name": "newName",
    "email": "new.email@example.com",
}
```

### Descrição dos Campos

* **login**: Novo login do usuário.
  * Tipo: *string*
  * Máximo de 255 caracteres.
  * Opcional (quando não for enviado, o valor não será alterado).

* **login**: Novo nome do usuário.
  * Tipo: *string*
  * Máximo de 255 caracteres.
  * Opcional (quando não for enviado, o valor não será alterado).

* **email**: Novo e-mail do usuário.
  * Tipo: *string*
  * Deve ser um e-mail válido.
  * Máximo de 255 caracteres.
  * Opcional (quando não for enviado, o valor não será alterado).

* **telephone**: Novo telefone do usuário.
  * Tipo: *string*
  * Máximo de 255 caracteres.
  * Opcional (quando não for enviado, o valor não será alterado).

## Response (204)

A resposta para a atualização dos dados do usuário não retorna conteúdo, apenas um status **204 No Content** indicando que a solicitação foi bem-sucedida.
