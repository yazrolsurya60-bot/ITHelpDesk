<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
    <div class="text-center mb-10">
        <div class="w-20 h-20 mx-auto bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mb-4 shadow-sm border border-emerald-200">
            <i class="fas fa-robot"></i>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">AI Assistant</h1>
        <p class="text-slate-500 font-medium mt-2">Tanyakan apapun seputar kendala IT Anda, dapatkan solusi instan.</p>
        <div class="inline-flex items-center mt-3 bg-indigo-50 text-indigo-600 px-4 py-1.5 rounded-full text-xs font-bold border border-indigo-100 shadow-sm">
            <i class="fas fa-bolt mr-1.5"></i> Garda Terdepan Dukungan IT
        </div>
    </div>

    <form action="<?php echo base_url('karyawan/chatbot'); ?>" method="post" id="aiForm" class="space-y-6 max-w-3xl mx-auto">
        <div>
            <label for="pertanyaan" class="block font-bold text-slate-700 mb-2 flex items-center">
                <i class="fas fa-pen-nib text-emerald-600 mr-2"></i> Pertanyaan Anda
            </label>
            <textarea name="pertanyaan" id="pertanyaan" 
                class="w-full p-4 border border-slate-300 rounded-2xl min-h-[120px] focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 outline-none transition-all resize-y text-slate-700 font-medium placeholder-slate-400" 
                placeholder="Ketik keluhan atau pertanyaan Anda di sini...&#10;Contoh: Bagaimana cara reset password email kantor?" required><?php echo htmlspecialchars($pertanyaan ?? ''); ?></textarea>
        </div>
        
        <button type="submit" id="submitBtn" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center text-lg">
            <i class="fas fa-paper-plane mr-2"></i> 
            <span id="btnText">Kirim Pertanyaan ke AI</span>
        </button>
    </form>

    <div id="loading" class="hidden text-center mt-8 p-6 max-w-3xl mx-auto">
        <i class="fas fa-circle-notch text-emerald-500 text-3xl animate-spin mb-3"></i>
        <p class="text-slate-600 font-bold animate-pulse">AI sedang memproses jawaban...</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mt-8 max-w-3xl mx-auto bg-rose-50 border-l-4 border-rose-500 p-5 rounded-r-xl shadow-sm">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-rose-500 mt-1 mr-3 text-lg"></i>
                <div>
                    <h4 class="text-rose-800 font-bold">Terjadi Kesalahan</h4>
                    <p class="text-rose-700 text-sm mt-1"><?php echo htmlspecialchars($error); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($jawaban)): ?>
        <div class="mt-8 max-w-3xl mx-auto bg-slate-50 border border-slate-200 rounded-2xl p-6 md:p-8 relative shadow-inner">
            <div class="absolute -top-3 left-6 bg-emerald-600 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center shadow-md">
                <i class="fas fa-lightbulb mr-1.5 text-yellow-300"></i> Jawaban AI
            </div>
            
            <style>
                .ai-markdown { font-size: 0.95rem; line-height: 1.6; color: #334155; }
                .ai-markdown p { margin-bottom: 0.75rem; }
                .ai-markdown h1, .ai-markdown h2, .ai-markdown h3, .ai-markdown h4 { font-weight: 700; color: #0f172a; margin-top: 1.25rem; margin-bottom: 0.5rem; }
                .ai-markdown h1 { font-size: 1.5rem; }
                .ai-markdown h2 { font-size: 1.25rem; }
                .ai-markdown h3 { font-size: 1.125rem; }
                .ai-markdown ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 0.75rem; }
                .ai-markdown ul li, .ai-markdown ol li { margin-bottom: 0.25rem; }
                .ai-markdown ol { list-style-type: decimal; padding-left: 1.5rem; margin-bottom: 0.75rem; }
                .ai-markdown strong { font-weight: 600; color: #1e293b; }
                .ai-markdown code { background: #f1f5f9; padding: 0.125rem 0.25rem; border-radius: 0.25rem; font-family: monospace; font-size: 0.85em; color: #0f172a; border: 1px solid #e2e8f0; }
                .ai-markdown pre { background: #1e293b; color: #f8fafc; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; margin-bottom: 0.75rem; font-size: 0.85rem; }
                .ai-markdown pre code { background: transparent; color: inherit; padding: 0; border: none; }
                .ai-markdown blockquote { border-left: 4px solid #cbd5e1; padding-left: 1rem; color: #64748b; font-style: italic; margin-bottom: 0.75rem; }
            </style>
            
            <div id="ai-response-content" class="ai-markdown mt-2">
                <!-- AI Markdown response will be rendered here -->
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
            <script>
                // Get the raw markdown from PHP safely
                const rawMarkdown = <?php echo json_encode($jawaban); ?>;
                // Parse and inject
                document.getElementById('ai-response-content').innerHTML = marked.parse(rawMarkdown);
            </script>
            
            <div class="mt-6 pt-4 border-t border-slate-200 flex justify-between items-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i> <?php echo date('d/m/Y H:i'); ?></span>
                <span class="flex items-center text-emerald-600"><i class="fas fa-check-circle mr-1.5"></i> Terjawab</span>
            </div>
        </div>
        
        <div class="mt-6 max-w-3xl mx-auto text-center">
            <p class="text-slate-600 mb-4 text-sm font-medium">Masih belum mendapatkan solusi? Buat tiket agar Staf IT dapat membantu Anda langsung.</p>
            <a href="<?php echo base_url('karyawan'); ?>" class="inline-block bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-700 transition">
                <i class="fas fa-ticket-alt mr-2"></i> Buat Laporan Tiket
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    document.getElementById('aiForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        const icon = btn.querySelector('i');
        const text = document.getElementById('btnText');
        
        icon.className = 'fas fa-spinner animate-spin mr-2';
        text.innerHTML = 'Memproses...';
        btn.classList.add('opacity-80', 'cursor-not-allowed');
        
        document.getElementById('loading').classList.remove('hidden');
    });
</script>
