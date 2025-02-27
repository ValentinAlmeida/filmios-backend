# Users - Search

**GET** */users*

## URL Param

* **login**: Login do usuário.
  * Tipo: *string* (máximo 255 caracteres)
* **cpf**: CPF do usuário.
  * Tipo: *string* 
* **name**: Nome do usuário.
  * Tipo: *string* 
* **telephone**: Telefone do usuário.
  * Tipo: *string* 
* **email**: Email do usuário.
  * Tipo: *string* (máximo 255 caracteres)
* **ativo**: Status de atividade do usuário.
  * Tipo: *boolean*
* **created_at**: Data de criação do usuário.
  * Tipo: *DateTime* (formato: `Y-m-d\TH:i:sP`)
* **locality_id**: Identificador da localidade do usuário.
  * Tipo: *integer*
* **profile_key**: Chave do perfil do usuário.
  * Tipo: *string*
* **page**: Página para paginação (opcional).
  * Tipo: *integer* (mínimo: 1)
* **perPage**: Número de itens por página (opcional).
  * Tipo: *integer* (mínimo: 1, máximo: 100)

## Request
```http
GET http://191.252.204.173/api/users?page=1&perPage=10 HTTP/1.1
Content-Type: application/json
```

## Response (200)

```http
HTTP/1.1 OK 200
{
    "results": [
        {
            "id": 1,
            "login": "12345678901",
            "cpf": "12345678901",
            "name": "John Vlogs",
            "email": "john.doe@example.com",
            "telephone": "71981903806",
            "block": false,
            "active": true,
            "localities": [
                {
                    "id": 1,
                    "description": "Salvador"
                },
                {
                    "id": 2,
                    "description": "Lauro de Freitas"
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
    ],
    "last_page": 1,
    "totalItems": 1,
    "totalPage": 100000
}
```

## Tipagem no Response (200)

### results

* **id**: Identificador do usuário.
  * Tipo: *integer*
* **login**: Login do usuário.
  * Tipo: *string*
* **cpf**: CPF do usuário.
  * Tipo: *string*
* **email**: Email do usuário.
  * Tipo: *string*
* **telephone**: Telefone do usuário.
  * Tipo: *string*
* **block**: Status de bloqueio do usuário.
  * Tipo: *boolean*
* **active**: Status de atividade do usuário.
  * Tipo: *boolean*
* **profile**: Informações sobre o perfil do usuário.
  * **id**: Identificador do perfil.
    * Tipo: *integer*
  * **description**: Descrição do perfil.
    * Tipo: *string*
  * **key**: Chave do perfil.
    * Tipo: *string*
  * **feature**: Lista de recursos do perfil.
    * **key**: Chave do recurso.
      * Tipo: *string*
    * **description**: Descrição do recurso.
      * Tipo: *string*
* **created_at**: Data de criação do usuário.
  * Tipo: *DateTime*

### Pagination

* **last_page**: Última página disponível.
  * Tipo: *integer*
* **totalItems**: Total de itens encontrados.
  * Tipo: *integer*
* **totalPage**: Total de páginas disponíveis.
  * Tipo: *integer*
