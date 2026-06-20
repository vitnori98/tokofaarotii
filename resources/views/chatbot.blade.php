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
        :root {
            --faa-primary: #004aad;
            --faa-primary-dark: #003580;
            --faa-accent: #f97316;
            --faa-bg: #eef1f5;
        }

        body {
            background: var(--faa-bg);
            padding-top: 100px;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .chat-container {
            flex-grow: 1;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            background: #fff;
            border-radius: 20px 20px 0 0;
            display: flex;
            flex-direction: column;
            box-shadow: 0 -8px 35px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .chat-header {
            padding: 18px 22px;
            background: linear-gradient(135deg, var(--faa-primary), var(--faa-primary-dark));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .chat-header-left { display: flex; align-items: center; gap: 14px; }

        .chat-avatar {
            width: 46px;
            height: 46px;
            background: #fff;
            color: var(--faa-primary);
            font-size: 1.3rem;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            background: #9ca3af; /* abu-abu = checking/offline */
            transition: background-color 0.3s ease;
        }
        .status-dot.online { background: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,0.25); }
        .status-dot.loading { background: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,0.25); }

        .chat-messages {
            flex-grow: 1;
            padding: 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
            scroll-behavior: smooth;
        }

        .msg {
            max-width: 78%;
            padding: 12px 18px;
            border-radius: 16px;
            font-size: 0.95rem;
            line-height: 1.55;
            animation: msgIn 0.25s ease;
            word-wrap: break-word;
        }

        @keyframes msgIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .msg-ai {
            align-self: flex-start;
            background: #f1f3f5;
            color: #2b2b2b;
            border-bottom-left-radius: 4px;
        }

        .msg-user {
            align-self: flex-end;
            background: var(--faa-accent);
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .msg-error {
            background: #fdecea;
            color: #b3261e;
            border: 1px solid #f6c4c0;
        }

        .typing-dots span {
            width: 6px;
            height: 6px;
            background: #9aa0a6;
            border-radius: 50%;
            display: inline-block;
            margin: 0 1px;
            animation: blink 1.2s infinite;
        }
        .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
        .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink {
            0%, 80%, 100% { opacity: 0.25; }
            40% { opacity: 1; }
        }

        .chat-input-area {
            padding: 16px 20px;
            background: #fff;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
        }

        .chat-input {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            flex-grow: 1;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .chat-input:focus {
            border-color: var(--faa-primary);
            box-shadow: 0 0 0 3px rgba(0, 74, 173, 0.12);
        }

        .btn-send {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 50%;
            background: var(--faa-primary);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-send:hover { background: var(--faa-primary-dark); }
        .btn-send:active { transform: scale(0.94); }
        .btn-send:disabled { background: #b9c5d6; cursor: not-allowed; }

        .quick-replies {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 0 24px 16px;
        }
        .quick-reply-btn {
            border: 1px solid var(--faa-primary);
            color: var(--faa-primary);
            background: #fff;
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 0.82rem;
            transition: all 0.15s ease;
        }
        .quick-reply-btn:hover {
            background: var(--faa-primary);
            color: #fff;
        }

        /* Scrollbar custom biar lebih rapi */
        .chat-messages::-webkit-scrollbar { width: 6px; }
        .chat-messages::-webkit-scrollbar-thumb { background: #d7dce2; border-radius: 10px; }
    </style>
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="chat-container">
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="chat-avatar rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-robot"></i>
                </div>
                <div>
                    <h5 class="m-0 fw-bold">FAA AI Assistant</h5>
                    <small class="opacity-75">
                        <span class="status-dot" id="statusDot"></span>
                        <span id="statusText">Menghubungkan...</span>
                    </small>
                </div>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">
            <div class="msg msg-ai">
                Halo <strong>{{ auth()->user()->name }}</strong>! 👋 Selamat datang di FAA Frozen Food & Bakery.
                Ada yang bisa saya bantu hari ini? Anda bisa bertanya tentang stok produk, promo terbaru,
                atau rekomendasi roti pilihan kami.
            </div>
        </div>

        <div class="quick-replies">
            <button type="button" class="quick-reply-btn" data-text="Apa saja produk rekomendasi di Toko FAA?">🍞 Produk Rekomendasi</button>
            <button type="button" class="quick-reply-btn" data-text="Apakah ada promo atau diskon minggu ini?">🎉 Promo Minggu Ini</button>
            <button type="button" class="quick-reply-btn" data-text="Kapan jam operasional toko FAA?">🕒 Jam Buka</button>
            <button type="button" class="quick-reply-btn" data-text="Dimana lokasi toko FAA?">📍 Lokasi Toko</button>
        </div>

        <div class="chat-input-area">
            <input type="text" class="form-control chat-input" id="userInput" placeholder="Ketik pesan Anda di sini..." autocomplete="off">
            <button class="btn-send" id="sendBtn" type="button">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatMessages = document.getElementById('chatMessages');
        const userInput     = document.getElementById('userInput');
        const sendBtn       = document.getElementById('sendBtn');
        const statusDot     = document.getElementById('statusDot');
        const statusText    = document.getElementById('statusText');
        const quickReplies  = document.querySelectorAll('.quick-reply-btn');

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function addMessage(text, type, isHtml = false) {
            const div = document.createElement('div');
            div.className = `msg msg-${type}`;
            div.innerHTML = isHtml ? text : escapeHtml(text);
            chatMessages.appendChild(div);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return div;
        }

        function setSending(isSending) {
            sendBtn.disabled = isSending;
            userInput.disabled = isSending;
        }

        async function handleSend(prefilledText) {
            const text = (prefilledText ?? userInput.value).trim();
            if (!text) return;

            addMessage(text, 'user');
            userInput.value = '';
            setSending(true);

            const loadingDiv = addMessage(
                '<div class="d-flex align-items-center gap-2">' +
                    '<span class="typing-dots"><span></span><span></span><span></span></span>' +
                    '<em class="text-muted">FAA AI sedang mengetik...</em>' +
                '</div>',
                'ai',
                true
            );

            try {
                const response = await fetch("{{ route('chatbot.proxy') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ message: text }),
                });

                const data = await response.json().catch(() => null);
                loadingDiv.remove();

                if (data && data.response) {
                    addMessage(data.response, response.ok ? 'ai' : 'error', true);
                } else {
                    addMessage('Maaf, terjadi kesalahan saat memproses jawaban.', 'error');
                }
            } catch (error) {
                loadingDiv.remove();
                addMessage('Maaf, FAA AI Assistant sedang beristirahat sejenak. Silakan tanya kembali beberapa saat lagi. 🙏', 'error');
                console.error('Koneksi Error:', error);
            } finally {
                setSending(false);
                userInput.focus();
            }
        }

        sendBtn.addEventListener('click', () => handleSend());
        userInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') handleSend();
        });

        quickReplies.forEach((btn) => {
            btn.addEventListener('click', () => handleSend(btn.dataset.text));
        });

        // Cek status AI di awal (endpoint opsional, lihat routes-chatbot.php)
        async function checkStatus() {
            try {
                const res = await fetch("{{ route('chatbot.status') }}");
                const data = await res.json();

                if (data.model_ready) {
                    statusDot.className = 'status-dot online';
                    statusText.textContent = 'Online | Siap membantu Anda';
                } else {
                    statusDot.className = 'status-dot loading';
                    statusText.textContent = 'AI sedang menyiapkan diri...';
                    setTimeout(checkStatus, 5000); // cek ulang tiap 5 detik
                }
            } catch (e) {
                statusDot.className = 'status-dot';
                statusText.textContent = 'Tidak terhubung ke server AI';
            }
        }
        checkStatus();
    });
    </script>
</body>
</html>