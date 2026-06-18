<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chatbot - FAA Frozen Food & Bakery</title>
    <link href="{{ asset('template-sarab/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('template-sarab/css/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f0f2f5; padding-top: 100px; height: 100vh; display: flex; flex-direction: column; }
        .chat-container { flex-grow: 1; max-width: 800px; margin: 0 auto; width: 100%; background: #fff; border-radius: 20px 20px 0 0; display: flex; flex-direction: column; box-shadow: 0 -5px 30px rgba(0,0,0,0.05); overflow: hidden; }
        .chat-header { padding: 20px; background: #004aad; color: #fff; display: flex; align-items: center; gap: 15px; }
        .chat-messages { flex-grow: 1; padding: 25px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px; }
        .msg { max-width: 80%; padding: 12px 18px; border-radius: 15px; font-size: 0.95rem; line-height: 1.5; }
        .msg-ai { align-self: flex-start; background: #f1f3f4; color: #333; border-bottom-left-radius: 2px; }
        .msg-user { align-self: flex-end; background: #f97316; color: #fff; border-bottom-right-radius: 2px; }
        .chat-input-area { padding: 20px; background: #fff; border-top: 1px solid #eee; display: flex; gap: 10px; }
        .chat-input { border-radius: 50px; padding: 12px 20px; border: 1px solid #ddd; flex-grow: 1; }
        .btn-send { width: 50px; height: 50px; border-radius: 50%; background: #004aad; color: #fff; border: none; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    </style>
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="chat-container">
        <div class="chat-header">
            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; color: #004aad !important;">
                <i class="bi bi-robot fs-4"></i>
            </div>
            <div>
                <h5 class="m-0 fw-bold">FAA AI Assistant</h5>
                <small class="opacity-75">Online | Siap membantu Anda</small>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">
            <div class="msg msg-ai">
                Halo <strong>{{ auth()->user()->name }}</strong>! 👋 Selamat datang di FAA Frozen Food & Bakery. Ada yang bisa saya bantu hari ini? Anda bisa bertanya tentang stok produk, promo terbaru, atau rekomendasi roti pilihan kami.
            </div>
        </div>

        <div class="chat-input-area">
            <input type="text" class="form-control chat-input" id="userInput" placeholder="Ketik pesan Anda di sini...">
            <button class="btn-send" id="sendBtn"><i class="bi bi-send-fill"></i></button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chatMessages');
            const userInput = document.getElementById('userInput');
            const sendBtn = document.getElementById('sendBtn');

            function addMessage(text, type) {
                const div = document.createElement('div');
                div.className = `msg msg-${type}`;
                div.innerHTML = text;
                chatMessages.appendChild(div);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function handleSend() {
                const text = userInput.value.trim();
                if (!text) return;

                addMessage(text, 'user');
                userInput.value = '';

                // Simulated AI response
                setTimeout(() => {
                    let response = "Maaf, fitur Chatbot AI sedang dalam tahap pemeliharaan. Namun, Anda tetap bisa memesan produk kami melalui menu Produk Makanan!";
                    if (text.toLowerCase().includes('halo') || text.toLowerCase().includes('hi')) {
                        response = "Halo juga! Ada yang bisa FAA AI bantu?";
                    } else if (text.toLowerCase().includes('roti')) {
                        response = "Kami memiliki berbagai varian roti segar! Anda bisa cek di kategori Bakery.";
                    }
                    addMessage(response, 'ai');
                }, 1000);
            }

            sendBtn.addEventListener('click', handleSend);
            userInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') handleSend(); });
        });
    </script>
</body>
</html>