# Teste - teste

**POST** */teste/:teste*
**GET** */teste/:teste*
**PUT** */teste/:teste*
**DELETE** */teste/:teste*

## URL Param

* **teste**: teste do teste
  * Tipo: *number* 

## Body

* **unidade_id**: Id que se referencia a entidade Unidade.
  * Tipo: *int*
* **especie_id**: Id que se referencia a entidade Especie.
  * Tipo: *int*
* **calibre_id**: Id que se referencia a entidade Calibre.
  * Tipo: *int*
* **marca_id**: Id que se referencia a entidade Marca.
  * Tipo: *int*
* **modelo_id**: Id que se referencia a entidade Modelo.
  * Tipo: *int*
* **capacidade**: Capacidade da arma.
  * Tipo: *int*
* **numero_serie**: Numero de serie da arma.
  * Tipo: *string*
* **numero_patrimonio**: Numero de patrimonio da arma.
  * Tipo: *string*
* **registro_sinarm**: Registro Sinarm da arma.
  * Tipo: *string*
* **rfid**: Rfid da arma.
  * Tipo: *string*
* **numero_oficio**: Numero do oficio da arma.
  * Tipo: *string*
* **observacao**: Observações da arma.
  * Tipo: *string*
* **inquerito**: Inquerito da arma.
  * Tipo: *string*
* **processo**: Processo da arma.
  * Tipo: *string*
* **numero_justica**: Numero de justiça da arma.
  * Tipo: *string*
* **numero_portaria_exercito**: Numero de portaria exercito da arma.
  * Tipo: *string*
* **decisao_judicial_path**: Codificação em Multipart Form Data do arquivo do documento. Neste campo o formato aceito é pdf.
  * Tipo: *File*
  * Mime: *pdf*
  * Tamanho máximo: *5MB*

## Request
```http
POST http://191.252.204.173/api/teste HTTP/1.1
GET http://191.252.204.173/api/teste HTTP/1.1
PUT http://191.252.204.173/api/teste HTTP/1.1
DELETE http://191.252.204.173/api/teste HTTP/1.1
Content-Type: application/json

{
  "email":"valentin@hrzon.com.br"
}
```

## Request
```http
POST http://191.252.204.173/api/inventario/perdidos/armas-patrimonias HTTP/1.1
Content-Type: multipart/form-data

{
    "unidade_id": 1,
    "especie_id": 1,
    "calibre_id": 1,
    "marca_id": 1,
    "modelo_id": 1,
    "capacidade": 10,
    "numero_serie": "ABC123",
    "numero_patrimonio": "XYZ456",
    "registro_sinarm": "DEF789",
    "rfid": null,
    "vara_criminal": "",
    "numero_oficio": "123",
    "observacao": "Observação...",
    "inquerito": "Inquérito...",
    "processo": "Processo...",
    "numero_justica": "789",
    "numero_portaria_exercito": "456",
    "decisao_judicial_path": null
}

```

## Response (200)

```http
HTTP/1.1 OK 200
[
    {
        "id": 1,
        "description": "user.search"
    },
    {
        "id": 2,
        "description": "user.create"
    },
    {
        "id": 3,
        "description": "user.delete"
    },
    {
        "id": 4,
        "description": "user.update"
    },
    {
        "id": 5,
        "description": "user.find"
    }
]

```

## Tipagem no Response (200)

### 
* **id**: Identificador
    * Tipo: *int*
* **matricula**: Identificador da entidade usuarios
    * Tipo: *string*
* **criado_em**: Data de criação
    * Tipo: *Date Time*
* **atualizado_em**: Data de atualização
    * Tipo: *Date Time*
* **deletado_em**: Data de exclusão
    * Tipo: *Date Time*
* **login**: Login do usuario
    * Tipo: *string*
* **ação**: Ação que o usuario tomou
    * Tipo: *string*


### 
* **id**: Identificador
    * Tipo: *int*
* **email**: Email da entidade usuarios
    * Tipo: *string*
* **token**: Token da solicitação da recuperação
    * Tipo: *string*
* **created_at**: Data de criação
    * Tipo: *Date Time*
* **deleted_at**: Data de exclusão
    * Tipo: *Date Time*
* **ação**: Ação que o usuario tomou
    * Tipo: *string*

## AVISO

Teste teste
