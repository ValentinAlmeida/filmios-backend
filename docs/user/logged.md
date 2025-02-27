### **Usuários - Buscar Usuário Logado**  
📌 **GET** `/users/logged`  

#### **🔹 Descrição**  
Retorna as informações do usuário atualmente autenticado.  

#### **🛠️ Requisitos**  
✅ **Autenticação**: Sim (Bearer Token)  

---

### **🔄 Parâmetros da Requisição**  
Nenhum parâmetro é necessário.  

---

### **📥 Exemplo de Requisição**  
```http
GET http://191.252.204.173/api/users/logged HTTP/1.1
Authorization: Bearer <seu_token>
Content-Type: application/json
```

---

### **📤 Exemplo de Resposta**  
```json
{
    "id": 2,
    "login": "12345678901",
    "name": "John Vlogs",
    "email": "john.doe@example.com",
    "block": false,
    "active": true,
    "created_at": "2025-02-27T23:12:47.000000Z",
    "updated_at": "2025-02-27T23:12:47.000000Z"
}
```

---

### **🛠 Possíveis Respostas**
| Código | Descrição |
|--------|----------|
| **200** ✅ | Usuário logado retornado com sucesso. |
| **401** ❌ | Não autenticado (Token inválido ou ausente). |
| **403** 🚫 | Usuário sem permissão para acessar essa rota. |

---
