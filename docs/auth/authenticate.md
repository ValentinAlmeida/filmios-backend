# Authentication - Authenticate

**POST** */authenticate*

## Body

* **login**: Login do usuário para autenticação.
  * Tipo: *string*
  * Regras de validação:
    * **required**: Campo obrigatório.
    * **string**: Deve ser uma string.

* **password**: Senha do usuário para autenticação.
  * Tipo: *string*
  * Regras de validação:
    * **required**: Campo obrigatório.
    * **string**: Deve ser uma string.

## Request
```http
POST http://191.252.204.173/api/authenticate HTTP/1.1
Content-Type: application/json

{
  "login": "12345678901",
  "password": "senha_secreta"
}
```

## Response (200)

```http
HTTP/1.1 OK 200
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg4NTAwNjIsIm5iZiI6MTczODg1MDA2MiwiZXhwIjoxNzM4OTY0MDYyLCJhdXRoZW50aWNhdGVkIjp7InVzZXIiOnsiaWQiOjEsImJsb2NrIjpmYWxzZSwiYWN0aXZlIjp0cnVlLCJsb2NhbGl0aWVzIjpbeyJpZCI6MSwiZGVzY3JpcHRpb24iOiJTYWx2YWRvciJ9LHsiaWQiOjIsImRlc2NyaXB0aW9uIjoiTGF1cm8gZGUgRnJlaXRhcyJ9XSwicHJvZmlsZSI6eyJpZCI6NCwiZGVzY3JpcHRpb24iOiJBZG1pbmlzdHJhZG9yIiwia2V5IjoicHJvZmlsZS5hZG1pbmlzdHJhZG9yIiwiZmVhdHVyZSI6W3sia2V5IjoiZmVhdHVyZS51c2VyLnNlYXJjaCIsImRlc2NyaXB0aW9uIjoiUHJvY3VyYXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUudXNlci5jcmVhdGUiLCJkZXNjcmlwdGlvbiI6IkNyaWFyIFVzdcOhcmlvIn0seyJrZXkiOiJmZWF0dXJlLnVzZXIuZGVsZXRlIiwiZGVzY3JpcHRpb24iOiJEZWxldGFyIFVzdcOhcmlvIn0seyJrZXkiOiJmZWF0dXJlLnVzZXIudXBkYXRlIiwiZGVzY3JpcHRpb24iOiJBdHVhbGl6YXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUudXNlci5maW5kIiwiZGVzY3JpcHRpb24iOiJDb25zdWx0YXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUucmVzcG9uc2libGUuZmluZCIsImRlc2NyaXB0aW9uIjoiQ29uc3VsdGFyIFJlc3BvbnPDoXZlbCJ9LHsia2V5IjoiZmVhdHVyZS5yZXNwb25zaWJsZS5zZWFyY2giLCJkZXNjcmlwdGlvbiI6IlByb2N1cmFyIFJlc3BvbnPDoXZlbCJ9LHsia2V5IjoiZmVhdHVyZS5yZXNwb25zaWJsZS51cGRhdGUiLCJkZXNjcmlwdGlvbiI6IkF0dWFsaXphciBSZXNwb25zw6F2ZWwifSx7ImtleSI6ImZlYXR1cmUucmVxdWVzdC51cGRhdGUiLCJkZXNjcmlwdGlvbiI6IkF0dWFsaXphciBTb2xpY2l0YcOnw6NvIn0seyJrZXkiOiJmZWF0dXJlLnJlcXVlc3Quc2VhcmNoIiwiZGVzY3JpcHRpb24iOiJQcm9jdXJhciBTb2xpY2l0YcOnw6NvIn0seyJrZXkiOiJmZWF0dXJlLnJlcXVlc3QuZmluZCIsImRlc2NyaXB0aW9uIjoiQ29uc3VsdGFyIFNvbGljaXRhw6fDo28ifV19LCJjcmVhdGVkX2F0IjoiMjAyNS0wMi0wNlQxMzozODoyOC4wMDAwMDBaIn0sInJlZnJlc2hfdG9rZW4iOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpJVXpJMU5pSjkuZXlKcFlYUWlPakUzTXpnNE5UQXdOaklzSW01aVppSTZNVGN6T0RnMU1EQTJNaXdpWlhod0lqb3hOek00T0RVM01qWXlMQ0p5WldaeVpYTm9YM1J2YTJWdUlqb2lNU0o5LkVHQWxwSHY0d3hBVTFqT3VjQlk2eFlxNExfQV9VRTJJaTZRdXpXcHdLNDQifX0.zxdLkJKFZIpLUmIOWqAwLnFx0Skb1aOTZYY3XJDZqRI",
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg4NTAwNjIsIm5iZiI6MTczODg1MDA2MiwiZXhwIjoxNzM4ODU3MjYyLCJyZWZyZXNoX3Rva2VuIjoiMSJ9.EGAlpHv4wxAU1jOucBY6xYq4L_A_UE2Ii6QuzWpwK44",
    "expires_on": "2025-02-07T18:34:22-03:00"
}
```

## Tipagem no Response (200)

* **token**: Token JWT gerado para o usuário autenticado.
  * Tipo: *string*

* **refresh_token**: Refresh Token JWT gerado para o usuário autenticado.
  * Tipo: *string*

* **expires_on**: Data e hora de expiração do token.
  * Tipo: *DateTime*
