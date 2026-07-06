<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sivita AI Agent</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            base: '#F5F5F4',
                            primary: '#7F1D1D', 
                            primaryDark: '#450A0A',
                            accent: '#D97706',  
                            accentLight: '#FEF3C7', 
                        }
                    },
                    animation: {
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                        'spin-slow': 'spin 1.5s linear infinite',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #F5F5F4;
            background-image: radial-gradient(#7F1D1D 0.5px, transparent 0.5px), radial-gradient(#7F1D1D 0.5px, #F5F5F4 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-attachment: fixed;
            background-opacity: 0.05; /* Efek grid halus */
        }
        
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(245, 245, 244, 0.95);
            z-index: -1;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #D97706;
        }
    </style>
</head>

<body class="font-sans text-gray-800 antialiased min-h-screen flex items-center justify-center p-4 selection:bg-brand-accent selection:text-white relative">
    
    <div class="grid-overlay"></div>

    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-gray-100 p-8 md:p-10 animate-slide-up relative overflow-hidden z-10">
        
        <!-- Aksen Dekoratif -->
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-brand-primary via-brand-accent to-brand-primary"></div>

        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto bg-brand-primary/10 text-brand-primary rounded-full flex items-center justify-center text-4xl mb-4 shadow-sm border border-brand-primary/20">
                <i class="fas fa-robot"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight">Sivita AI Agent</h1>
            <p class="text-gray-500 font-medium mt-2">Tanyakan apapun, dapatkan jawaban dari kecerdasan buatan.</p>
            <div class="inline-flex items-center mt-3 bg-brand-accentLight text-brand-accent px-4 py-1.5 rounded-full text-xs font-bold border border-brand-accent/20 shadow-sm">
                <i class="fas fa-bolt mr-1.5"></i> Powered by LLM7
            </div>
        </div>

        <form action="<?= site_url('ai_test'); ?>" method="post" id="aiForm" class="space-y-6">
            <div>
                <label for="pertanyaan" class="block font-bold text-gray-700 mb-2 flex items-center">
                    <i class="fas fa-pen-nib text-brand-accent mr-2"></i> Pertanyaan Anda
                </label>
                <textarea name="pertanyaan" id="pertanyaan" 
                    class="w-full p-4 border-2 border-gray-200 rounded-2xl min-h-[120px] focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 outline-none transition-all resize-y text-gray-700 font-medium placeholder-gray-400" 
                    placeholder="Ketik pertanyaan Anda di sini...&#10;Contoh: Apa itu kecerdasan buatan?" required><?= htmlspecialchars($pertanyaan ?? ''); ?></textarea>
            </div>
            
            <button type="submit" id="submitBtn" class="w-full bg-brand-primary hover:bg-brand-primaryDark text-white font-bold py-4 rounded-2xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 flex items-center justify-center text-lg group">
                <i class="fas fa-paper-plane mr-2 group-hover:animate-bounce"></i> 
                <span id="btnText">Kirim Pertanyaan</span>
            </button>
        </form>

        <div id="loading" class="hidden text-center mt-8 p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <i class="fas fa-circle-notch text-brand-accent text-3xl animate-spin-slow mb-3"></i>
            <p class="text-gray-600 font-bold animate-pulse">AI sedang memproses jawaban...</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="mt-8 bg-red-50 border-l-4 border-red-500 p-5 rounded-r-xl shadow-sm animate-slide-up">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-1 mr-3 text-lg"></i>
                    <div>
                        <h4 class="text-red-800 font-bold">Terjadi Kesalahan</h4>
                        <p class="text-red-700 text-sm mt-1"><?= htmlspecialchars($error); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($jawaban)): ?>
            <div class="mt-8 bg-brand-base border border-gray-200 rounded-2xl p-6 md:p-8 animate-slide-up relative shadow-inner">
                <div class="absolute -top-3.5 left-6 bg-brand-primary text-white text-xs font-bold px-3 py-1 rounded-full flex items-center shadow-md">
                    <i class="fas fa-lightbulb mr-1.5 text-brand-accent"></i> Jawaban AI
                </div>
                
                <div class="prose prose-sm md:prose-base prose-brand text-gray-700 leading-relaxed max-w-none mt-2 whitespace-pre-wrap word-wrap break-word">
                    <?= nl2br(htmlspecialchars($jawaban)); ?>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200 flex justify-between items-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                    <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i> <?= date('d/m/Y H:i:s'); ?></span>
                    <span class="flex items-center text-brand-accent"><i class="fas fa-check-double mr-1.5"></i> Berhasil</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-10 pt-6 border-t border-gray-100 text-center text-sm font-semibold text-gray-400">
            <i class="fas fa-heart text-red-500 mx-1"></i>
            <p class="mt-1">© <?= date('Y'); ?> Sistem Informasi - All rights reserved</p>
        </div>
    </div>

    <script>
        document.getElementById('aiForm').addEventListener('submit', function () {
            const btn = document.getElementById('submitBtn');
            const icon = btn.querySelector('i');
            const text = document.getElementById('btnText');
            
            icon.className = 'fas fa-spinner animate-spin-slow mr-2';
            text.innerHTML = 'Memproses...';
            btn.classList.add('opacity-80', 'cursor-not-allowed');
            btn.classList.remove('hover:-translate-y-1', 'hover:shadow-xl', 'hover:bg-brand-primaryDark');
            
            document.getElementById('loading').classList.remove('hidden');
        });
    </script>
</body>

</html>