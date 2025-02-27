# Users - Update

**PUT** */users/{id}*

## Parâmetros da URL

* **id**: Identificador único do usuário.
  * Tipo: *integer*
  * Exemplo: `1`

### Request Exemplo
```http
PUT http://191.252.204.173/api/users/1 HTTP/1.1
Content-Type: application/json

{
    "login": "newlogin",
    "cpf": "12345678901",
    "email": "new.email@example.com",
    "telephone": "71981903801",
    "profile_key": "profile.gestor",
    "localities": [1],
    "active": true,
    "blocked": false
}
```

### Descrição dos Campos

* **login**: Novo login do usuário.
  * Tipo: *string*
  * Máximo de 255 caracteres.
  * Opcional (quando não for enviado, o valor não será alterado).

* **cpf**: Novo CPF do usuário. 
  * Tipo: *string*
  * Validação de CPF (deve ser único e válido, com exclusão de registros apagados).
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

* **profile_key**: Chave do perfil do usuário.
  * Tipo: *string*
  * Obrigatorio

* **localities**: Array de Identificadores da localidade do usuário.
  * Tipo: *integer*
  * Opcional (quando não for enviado, o valor não será alterado).

* **active**: Indica se o usuário está ativo.
  * Tipo: *boolean*
  * Opcional (quando não for enviado, o valor não será alterado).

* **blocked**: Indica se o usuário está bloqueado.
  * Tipo: *boolean*
  * Opcional (quando não for enviado, o valor não será alterado).

## Response (204)

A resposta para a atualização dos dados do usuário não retorna conteúdo, apenas um status **204 No Content** indicando que a solicitação foi bem-sucedida.
