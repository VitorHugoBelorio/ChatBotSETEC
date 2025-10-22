# 🤖 ChatBot SETEC

Um assistente educacional interativo voltado para alunos da área de tecnologia, com foco em **Programação**, **Banco de Dados**, **Redes de Computadores**, **Engenharia de Software** e **Desenvolvimento Web**.  
O ChatBot SETEC foi desenvolvido para gerar **conteúdos técnicos e educativos** de forma **clara, organizada e didática**, simulando o comportamento de um **tutor universitário virtual**.

---

## 📚 Material de Apoio da Palestra e Slides

🔗 **Link do Drive:** [Clique aqui para acessar](https://drive.google.com/drive/folders/1ncrLrbMHxBQKpIwmsEiHXOsm4fVsgkgt?usp=sharing)

> 💡 O material inclui slides, códigos e recursos adicionais apresentados durante a palestra.

---

## 🚀 Como Executar o Projeto

### 1. Pré-requisitos

-   PHP 8.1 ou superior
-   Composer
-   MySQL
-   XAMPP
-   VS Code
-   Git

### 2. Clonando o Projeto

```bash
git clone https://github.com/VitorHugoBelorio/ChatBotSETEC
cd ChatBotSETEC
code .
```

### 3. Instalação das Dependências

```bash
composer install
```

### 4. Configuração do Ambiente

1. **Copie o arquivo de ambiente**

```bash
cp .env.example .env
```

2. **Configure o Gemini API**

    - Acesse [Google AI Studio](https://aistudio.google.com/app/api-keys)
    - Gere sua API Key
    - Cole no `.env`: `GEMINI_API_KEY=sua_chave_aqui`

3. **Configure o banco de dados**
    - Inicie o XAMPP (MySQL)
    - Execute no MySQL:
    ```sql
    create database chat_ia;
    ```
    - Configure o `.env` com suas credenciais do MySQL

### 5. Finalizando a Configuração

```bash
php artisan key:generate
php artisan migrate
```

### 6. Executando o Projeto

```bash
php artisan serve
```

Acesse: [http://localhost:8000](http://localhost:8000)

---

## 🧠 Funcionalidades do Chatbot

O assistente fornece respostas estruturadas com:

-   Explicações concisas
-   Questões de estudo
-   Exemplos práticos
-   Dicas de estudo

---

## 🛠️ Tecnologias Utilizadas

-   Laravel
-   MySQL
-   XAMPP
-   Google Gemini API
-   Composer

---

## ✨ Desenvolvido por

**Vitor Hugo Belório**  
Projeto apresentado na **Semana de Educação, Tecnologia e Ciência (SETEC) 21 de outubro 2025**

---

## 📋 Salvando Uma Cópia do Projeto (Para Participantes do Mini Curso)

### 1. Criando Seu Próprio Repositório

1. Acesse [GitHub](https://github.com)
2. Clique em "New repository" (botão verde '+' no canto superior direito)
3. Nome sugerido: `meu-chatbot-setec`
4. Marque como "Public"
5. Não adicione README, .gitignore ou License
6. Clique em "Create repository"

### 2. Clonando e Configurando

```bash
# Clone o projeto original
git clone https://github.com/VitorHugoBelorio/ChatBotSETEC
cd ChatBotSETEC

# Remova o vínculo com o repositório original
git remote remove origin

# Adicione seu repositório como novo origin
git remote add origin https://github.com/SEU-USERNAME/meu-chatbot-setec

# Envie o código para seu repositório
git branch -M main
git push -u origin main
```

> 💡 **Dica**: Substitua `SEU-USERNAME` pelo seu nome de usuário do GitHub e `meu-chatbot-setec` pelo nome que você escolheu para seu repositório
