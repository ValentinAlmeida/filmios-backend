# Users - Criação de Usuário Sem Perfil

**POST** */users/noProfile*

## Parâmetros da Requisição

* **cpf**: Número do CPF do usuário.
  * Tipo: *string*
  * Regras:
    * Obrigatório (`required`)
    * Deve ser uma string válida de CPF (`CpfValidationRule`)
    * Deve ser único na tabela de usuários, considerando que o campo `deleted_at` seja `null` (usuário ativo).
  * Exemplo: `12345678901`

* **email**: Endereço de email do usuário.
  * Tipo: *string*
  * Regras:
    * Obrigatório (`required`)
    * Deve ser um email válido (`email`)
    * Comprimento máximo de 255 caracteres (`max:255`)
  * Exemplo: `john.doe@example.com`

* **name**: Nome do usuário.
  * Tipo: *string* (máximo 255 caracteres)
  * Regras de validação:
    - Obrigatório

* **telephone**: Telefone do usuário.
  * Tipo: *string* (máximo 255 caracteres)
  * Regras de validação:
    - Obrigatório

* **url**: URL adicional associada ao usuário.
  * Tipo: *string* (opcional)
  * Regras:
    * Opcional (`sometimes`)
    * Deve ser uma URL válida (`url`)
  * Exemplo: `http://www.exemplo.com`

---

### Request Exemplo

```http
POST http://191.252.204.173/api/users/noProfile HTTP/1.1
Content-Type: application/json

{
    "cpf": "12345678901",
    "email": "john.doe@example.com",
    "url": "http://www.exemplo.com",
    "name": "John",
    "telephone": "71981903805"
}
```

---

### Response

* **204 No Content**: Indica que o usuário foi criado com sucesso, mas não há conteúdo adicional na resposta.

---

### Respostas Possíveis

* **204 No Content**: Usuário criado com sucesso sem perfil.
* **400 Bad Request**: Erro de validação, como:
  * CPF ou email inválidos ou já existentes.
  * URL inválida.
* **404 Not Found**: Caso a rota ou a URL esteja incorreta.

---
