# Users - Find by ID

**GET** */users/{id}*

## Parâmetros da URL

* **id**: Identificador único do usuário.
  * Tipo: *integer*
  * Exemplo: `1`

### Request Exemplo
```http
GET http://191.252.204.173/api/users/1 HTTP/1.1
```

## Response (200)

### Exemplo de Resposta
```json
{
    "id": 1,
    "login": "12345678901",
    "cpf": "12345678901",
    "name": "John Vlogs",
    "email": "john.doe@example.com",
    "telephone": "71981903801",
    "block": false,
    "active": true,
    "localities": [
        {
            "id": 1,
            "description": "Salvador"
        }
    ],
    "profile": {
        "id": 4,
        "description": "Administrador",
        "key": "profile.administrador",
        "feature": [
            {
                "key": "feature.user.search",
                "description": "Procurar Usuário"
            },
            {
                "key": "feature.user.create",
                "description": "Criar Usuário"
            },
            {
                "key": "feature.user.delete",
                "description": "Deletar Usuário"
            },
            {
                "key": "feature.user.update",
                "description": "Atualizar Usuário"
            },
            {
                "key": "feature.user.find",
                "description": "Consultar Usuário"
            },
            {
                "key": "feature.responsible.find",
                "description": "Consultar Responsável"
            },
            {
                "key": "feature.responsible.search",
                "description": "Procurar Responsável"
            },
            {
                "key": "feature.responsible.update",
                "description": "Atualizar Responsável"
            },
            {
                "key": "feature.request.update",
                "description": "Atualizar Solicitação"
            },
            {
                "key": "feature.request.search",
                "description": "Procurar Solicitação"
            },
            {
                "key": "feature.request.find",
                "description": "Consultar Solicitação"
            }
        ]
    },
    "created_at": "2025-01-30T17:01:20.000000Z"
}
```

### Descrição da Resposta

A resposta retorna os seguintes campos:

* **id**: Identificador do usuário.
* **login**: Login do usuário.
* **name**: Nome do usuário.
* **cpf**: CPF do usuário.
* **telephone**: Telefone do usuário.
* **email**: Endereço de email do usuário.
* **block**: Status de bloqueio do usuário (booleano).
* **active**: Status de atividade do usuário (booleano).
* **profile**: Dados do perfil do usuário, incluindo o ID, descrição, Key e permissões associadas.
* **created_at**: Data de criação do usuário.
