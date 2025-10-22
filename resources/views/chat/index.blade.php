<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Chat IA - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 700px;">
    <h3 class="mb-4 text-center">💬 Chat com IA (Gemini)</h3>

    <div class="card shadow-sm border-0">
        <div id="chat-box" class="p-3 bg-white border rounded overflow-auto" style="height: 400px;">
            <!-- As mensagens aparecerão aqui -->
        </div>

        <form id="chat-form" class="mt-3">
            <div class="input-group">
                <textarea id="message" class="form-control" rows="2" placeholder="Digite sua pergunta..." required></textarea>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>

        <div class="text-end mt-3">
            <button id="clear-chat" class="btn btn-outline-secondary btn-sm">Limpar Chat</button>
        </div>
    </div>
</div>

<script>
const form = document.getElementById("chat-form");
const chatBox = document.getElementById("chat-box");
const messageInput = document.getElementById("message");

// Envio de mensagem
form.addEventListener("submit", async function(e) {
    e.preventDefault();
    let message = messageInput.value.trim();
    if (!message) return;

    // Adiciona mensagem do usuário
    let userMsg = document.createElement("div");
    userMsg.classList.add("d-flex", "justify-content-end", "mb-2");
    userMsg.innerHTML = `<div class="bg-primary text-white p-2 rounded-3" style="max-width: 75%; white-space: pre-wrap;">${message}</div>`;
    chatBox.appendChild(userMsg);

    // Limpa campo imediatamente
    messageInput.value = "";
    messageInput.focus();

    // Adiciona indicador de carregamento
    let loadingId = 'loading-' + Date.now();
    let loadingMsg = document.createElement("div");
    loadingMsg.classList.add("d-flex", "justify-content-start", "mb-2");
    loadingMsg.id = loadingId;
    loadingMsg.innerHTML = `<div class="bg-light text-secondary p-2 rounded-3 border"><b>IA:</b> Pensando...</div>`;
    chatBox.appendChild(loadingMsg);
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        let response = await fetch("{{ route('chat.send') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message })
        });

        if (!response.ok) throw new Error('Erro na resposta da API: ' + response.status);
        let data = await response.json();

        // Remove indicador de carregamento
        document.getElementById(loadingId)?.remove();

        // Adiciona resposta da IA formatada
        let iaMsg = document.createElement("div");
        iaMsg.classList.add("d-flex", "justify-content-start", "mb-2");

        // Substitui \n por <br> e mantém formatação
        let formattedText = String(data)
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>'); // suporte a **negrito**

        iaMsg.innerHTML = `<div class="bg-light border p-2 rounded-3" style="max-width: 75%; white-space: pre-wrap;"><b>IA:</b> ${formattedText}</div>`;
        chatBox.appendChild(iaMsg);

    } catch (error) {
        document.getElementById(loadingId)?.remove();
        console.error('Erro:', error);

        let errorMsg = document.createElement("div");
        errorMsg.classList.add("d-flex", "justify-content-start", "mb-2");
        errorMsg.innerHTML = `<div class="bg-danger text-white p-2 rounded-3" style="max-width: 75%;"><b>Erro:</b> Não foi possível gerar uma resposta.</div>`;
        chatBox.appendChild(errorMsg);
    }

    chatBox.scrollTop = chatBox.scrollHeight;
});

// Enter envia / Shift+Enter quebra linha
messageInput.addEventListener("keydown", function(e) {
    if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        form.dispatchEvent(new Event("submit"));
    }
});

// Botão limpar chat
document.getElementById("clear-chat").addEventListener("click", function() {
    chatBox.innerHTML = "";
});
</script>


</body>
</html>
