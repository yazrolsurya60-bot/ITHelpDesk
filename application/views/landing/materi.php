<div class="content-section">
    <div class="flex items-center mb-8 animate-fade-up">
        <div class="w-1.5 h-8 bg-brand-accent rounded-full mr-4"></div>
        <h1 class="page-title !mb-0">Materi Akademik</h1>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 animate-fade-up" style="animation-delay: 0.1s;">
        <p class="text-gray-600 mb-6">
            Berikut adalah daftar materi atau panduan akademik yang dapat Anda akses:
        </p>
        
        <?php if(!empty($files)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach($files as $index => $file): ?>
                    <a href="<?= base_url('materi/' . $file) ?>" target="_blank" 
                       class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl border border-gray-200 hover:border-brand-accent hover:bg-orange-50 transition-all duration-300 transform hover:-translate-y-1 group">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:bg-brand-accent transition-colors duration-300">
                            <i class="fas fa-file-alt text-2xl text-brand-primary group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <span class="text-sm font-semibold text-center text-gray-700 group-hover:text-brand-primaryDark line-clamp-2">
                            <?= htmlspecialchars($file) ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="flex flex-col items-center justify-center py-12 px-4 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Materi</h3>
                <p class="text-gray-500 max-w-sm">
                    Saat ini belum ada dokumen materi yang diunggah ke dalam folder direktori.
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
