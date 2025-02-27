# Authentication - Recover Password

**POST** */recover-password*

## Body

* **email**: Email do usuário para recuperação de senha.
  * Tipo: *string*
  * Regras de validação:
    * **required**: Campo obrigatório.
    * **email**: Deve ser um email válido.

* **url**: URL de redirecionamento após a recuperação de senha (opcional).
  * Tipo: *string*
  * Regras de validação:
    * **sometimes**: Campo opcional.
    * **url**: Deve ser uma URL válida, caso fornecida.

## Request
```http
POST http://191.252.204.173/api/recover-password HTTP/1.1
Content-Type: application/json

{
  "email": "john.doe@example.com",
  "url": "http://example.com/recover"
}
```

## Response (200)

```http
HTTP/1.1 OK 200
{
    "message": "Recuperação de senha solicitada com sucesso. Verifique seu e-mail para instruções."
}
```

## Tipagem no Response (200)

* **message**: Mensagem de sucesso informando que a solicitação de recuperação de senha foi realizada com sucesso.
  * Tipo: *string*
