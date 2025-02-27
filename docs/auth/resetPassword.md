# Autenticação - Redefinição de Senha

**PUT** */reset-password*

## Middleware
- **recovery.user**: Verifica se o token recebido durante o processo de recuperação de senha é válido.

---

## Parâmetros da Requisição

* **password**: Nova senha do usuário.
  * Tipo: *string*
  * Regras:
    * Opcional (`sometimes`)
    * Deve ter no mínimo 8 caracteres (`min:8`)
    * Deve ser confirmada com o parâmetro `password_confirmation` (`confirmed`)
  * Exemplo: `NovaSenha123`

* **password_confirmation**: Confirmação da nova senha.
  * Tipo: *string*
  * Regras:
    * Opcional (`sometimes`)
    * Deve ser igual ao parâmetro `password`
    * Deve ter no mínimo 8 caracteres (`min:8`)
  * Exemplo: `NovaSenha123`

* **Token**: Necessário para validar o pedido de redefinição. O token é enviado previamente no processo de recuperação de senha.

---

### Request Exemplo

```http
PUT http://191.252.204.173/api/reset-password HTTP/1.1
Content-Type: application/json
Authorization: Bearer <token_de_recuperacao>

{
    "password": "NovaSenha123",
    "password_confirmation": "NovaSenha123"
}
```

---

### Response

* **201 Created**: Indica que a senha foi redefinida com sucesso.

---

### Respostas Possíveis

* **201 Created**: Senha redefinida com sucesso.
* **400 Bad Request**: Erro de validação nos parâmetros, como:
  * Senha e confirmação de senha não coincidem.
  * Senha com menos de 8 caracteres.
* **401 Unauthorized**: Token inválido ou ausente no cabeçalho da requisição.
* **403 Forbidden**: Token expirado ou já utilizado.
* **404 Not Found**: Usuário não encontrado para o token fornecido.

---
