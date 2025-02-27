# Users - Create

**POST** */users*

## Request Body

### Campos

* **cpf**: CPF do usuário.
  * Tipo: *string* 
  * Regras de validação:
    - Obrigatório
    - Deve ser um CPF válido (utiliza `CpfValidationRule`)
    - Deve ser único na tabela `users` (onde `deleted_at` é nulo)
* **email**: Email do usuário.
  * Tipo: *string* (máximo 255 caracteres)
  * Regras de validação:
    - Obrigatório
    - Deve ser um email válido
* **name**: Nome do usuário.
  * Tipo: *string* (máximo 255 caracteres)
  * Regras de validação:
    - Obrigatório
* **telephone**: Telefone do usuário.
  * Tipo: *string* (máximo 255 caracteres)
  * Regras de validação:
    - Obrigatório
* **url**: URL relacionada ao usuário (opcional).
  * Tipo: *string*
  * Regras de validação:
    - Se fornecido, deve ser uma URL válida
* **profile_key**: Chave do perfil do usuário (obrigatorio).
  * Tipo: *string*
  * Regras de validação:
    - Deve ser uma key válida existente na tabela `profiles`
* **localities**: Array de Identificadores da localidade do usuário (opcional).
  * Tipo: *integer*
  * Regras de validação:
    - Deve ser um identificador válido existente na tabela `localities`

### Request Exemplo
```http
POST http://191.252.204.173/api/users HTTP/1.1
Content-Type: application/json
{
    "cpf": "46030102060",
    "email": "valentin@hrzon.com.br",
    "profile_key": "profile.gestor",
    "localities": [1],
    "name": "Valentin",
    "telephone": "71981903805"
}
```

## Response (201)

### Retorno

**Status Code**: 201 Created

```http
HTTP/1.1 201 Created
```
