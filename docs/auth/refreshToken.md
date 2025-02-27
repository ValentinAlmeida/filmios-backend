# Autenticação - Renovação de Token

**POST** */authenticate/refreshToken*

---

## Descrição

Renova um token de autenticação utilizando o `refresh_token`.

---

## Middleware

* **refresh.token**: Verifica a validade do token de renovação.

---

## Corpo da Requisição

```json
{
    "refresh_token": "string"
}
```

### Validações

| Campo           | Tipo     | Obrigatório | Validações                            |
|------------------|----------|-------------|---------------------------------------|
| `refresh_token` | `string` | Sim         | Deve ser um token válido de renovação |

---

## Exemplo de Requisição

```http
POST http://191.252.204.173/api/authenticate/refreshToken HTTP/1.1
Content-Type: application/json
Authorization: Bearer <token_atual>

{
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzc2NjAwNTMsIm5iZiI6MTczNzY2MDA1MywiZXhwIjoxNzM3NjY3MjUzLCJyZWZyZXNoX3Rva2VuIjoiOCJ9.T33nxHVRsIwx6Bkdg1I0kcot6EE8l18rtrmxMMk7Ls8"
}
```

---

## Exemplo de Resposta

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg4NTAxMDksIm5iZiI6MTczODg1MDEwOSwiZXhwIjoxNzM4OTY0MTA5LCJhdXRoZW50aWNhdGVkIjp7InVzZXIiOnsiaWQiOjEsImJsb2NrIjpmYWxzZSwiYWN0aXZlIjp0cnVlLCJsb2NhbGl0aWVzIjpbeyJpZCI6MSwiZGVzY3JpcHRpb24iOiJTYWx2YWRvciJ9LHsiaWQiOjIsImRlc2NyaXB0aW9uIjoiTGF1cm8gZGUgRnJlaXRhcyJ9XSwicHJvZmlsZSI6eyJpZCI6NCwiZGVzY3JpcHRpb24iOiJBZG1pbmlzdHJhZG9yIiwia2V5IjoicHJvZmlsZS5hZG1pbmlzdHJhZG9yIiwiZmVhdHVyZSI6W3sia2V5IjoiZmVhdHVyZS51c2VyLnNlYXJjaCIsImRlc2NyaXB0aW9uIjoiUHJvY3VyYXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUudXNlci5jcmVhdGUiLCJkZXNjcmlwdGlvbiI6IkNyaWFyIFVzdcOhcmlvIn0seyJrZXkiOiJmZWF0dXJlLnVzZXIuZGVsZXRlIiwiZGVzY3JpcHRpb24iOiJEZWxldGFyIFVzdcOhcmlvIn0seyJrZXkiOiJmZWF0dXJlLnVzZXIudXBkYXRlIiwiZGVzY3JpcHRpb24iOiJBdHVhbGl6YXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUudXNlci5maW5kIiwiZGVzY3JpcHRpb24iOiJDb25zdWx0YXIgVXN1w6FyaW8ifSx7ImtleSI6ImZlYXR1cmUucmVzcG9uc2libGUuZmluZCIsImRlc2NyaXB0aW9uIjoiQ29uc3VsdGFyIFJlc3BvbnPDoXZlbCJ9LHsia2V5IjoiZmVhdHVyZS5yZXNwb25zaWJsZS5zZWFyY2giLCJkZXNjcmlwdGlvbiI6IlByb2N1cmFyIFJlc3BvbnPDoXZlbCJ9LHsia2V5IjoiZmVhdHVyZS5yZXNwb25zaWJsZS51cGRhdGUiLCJkZXNjcmlwdGlvbiI6IkF0dWFsaXphciBSZXNwb25zw6F2ZWwifSx7ImtleSI6ImZlYXR1cmUucmVxdWVzdC51cGRhdGUiLCJkZXNjcmlwdGlvbiI6IkF0dWFsaXphciBTb2xpY2l0YcOnw6NvIn0seyJrZXkiOiJmZWF0dXJlLnJlcXVlc3Quc2VhcmNoIiwiZGVzY3JpcHRpb24iOiJQcm9jdXJhciBTb2xpY2l0YcOnw6NvIn0seyJrZXkiOiJmZWF0dXJlLnJlcXVlc3QuZmluZCIsImRlc2NyaXB0aW9uIjoiQ29uc3VsdGFyIFNvbGljaXRhw6fDo28ifV19LCJjcmVhdGVkX2F0IjoiMjAyNS0wMi0wNlQxMzozODoyOC4wMDAwMDBaIn0sInJlZnJlc2hfdG9rZW4iOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpJVXpJMU5pSjkuZXlKcFlYUWlPakUzTXpnNE5Ea3hNVFlzSW01aVppSTZNVGN6T0RnME9URXhOaXdpWlhod0lqb3hOek00T0RVMk16RTJMQ0p5WldaeVpYTm9YM1J2YTJWdUlqb2lNU0o5Lko0aloxd05uTnBVMVhmVVRjZ3ljMVJPVGZqWkRJcm11bFBFb3R4eVoxRWsifX0.zvwm-OUjLFn9ZB0AxYpVaOWvGoD8ELHl47kNszca7Xc",
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg4NDkxMTYsIm5iZiI6MTczODg0OTExNiwiZXhwIjoxNzM4ODU2MzE2LCJyZWZyZXNoX3Rva2VuIjoiMSJ9.J4jZ1wNnNpU1XfUTcgyc1ROTfjZDIrmulPEotxyZ1Ek",
    "expires_on": "2025-02-07T18:35:09-03:00"
}
```

### Campos da Resposta

| Campo            | Tipo     | Descrição                                         |
|------------------|----------|---------------------------------------------------|
| `token`          | `string` | Novo token de autenticação                        |
| `refresh_token`  | `string` | Novo token de renovação                           |
| `expires_on`     | `string` | Data e hora de expiração do novo token (ISO 8601) |

---

## Respostas Possíveis

| Código | Descrição                                              |
|--------|--------------------------------------------------------|
| 201    | Token renovado com sucesso                            |
| 400    | Dados inválidos ou `refresh_token` ausente            |
| 401    | Token de autenticação inválido ou expirado            |
| 403    | O `refresh_token` fornecido não é válido              |

---
