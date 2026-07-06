

<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Daftar Tugas</h2>
        <p class="text-slate-500 text-sm mt-1">Kelola dan selesaikan tiket bantuan yang ditugaskan kepada Anda.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
    <?php if(empty($tickets)): ?>
    <div class="col-span-full py-16 px-4 text-center bg-white rounded-2xl shadow-sm border border-slate-200">
        <div class="w-24 h-24 bg-emerald-50 text-emerald-400 rounded-full flex items-center justify-center text-5xl mx-auto mb-4">
            <i class="fas fa-check"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Semua Tugas Selesai!</h3>
        <p class="text-slate-500 font-medium max-w-md mx-auto">Anda tidak memiliki tiket tugas yang tertunda saat ini. Nikmati waktu istirahat Anda.</p>
    </div>
    <?php endif; ?>

    <?php foreach($tickets as $t): ?>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-lg hover:-translate-y-1 transition duration-300 group">
        <!-- Card Header -->
        <div class="p-5 border-b border-slate-100 bg-slate-50 flex justify-between items-start">
            <div>
                <div class="flex items-center space-x-2 mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-slate-200 text-slate-700">
                        <i class="fas fa-tag mr-1.5 text-slate-400"></i> <?php echo $t->nama_kategori; ?>
                    </span>
                    <?php if($t->status_tiket == 'Menunggu' || $t->status_tiket == 'Menuju Lokasi' || $t->status_tiket == 'Dikerjakan'): ?>
                        <span class="relative flex h-2.5 w-2.5 ml-1">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full <?php echo ($t->status_tiket == 'Menuju Lokasi') ? 'bg-emerald-400' : 'bg-amber-400'; ?> opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 <?php echo ($t->status_tiket == 'Menuju Lokasi') ? 'bg-emerald-500' : 'bg-amber-500'; ?>"></span>
                        </span>
                    <?php endif; ?>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Tiket #<?php echo str_pad($t->id_tiket, 4, '0', STR_PAD_LEFT); ?></h3>
            </div>
            
            <div class="text-right">
                <p class="text-xs text-slate-400 font-medium mb-1">Dilaporkan</p>
                <p class="text-sm font-semibold text-slate-600"><?php echo date('d M, H:i', strtotime($t->waktu_dibuat)); ?></p>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="p-5 flex-1 space-y-4">
            <div class="flex items-start space-x-3">
                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold flex-shrink-0">
                    <?php echo strtoupper(substr($t->pelapor, 0, 1)); ?>
                </div>
                <div>
                    <p class="text-xs text-slate-400 uppercase font-semibold tracking-wider mb-0.5">Pelapor</p>
                    <p class="text-slate-800 font-medium"><?php echo $t->pelapor; ?></p>
                </div>
            </div>
            
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div class="flex items-center text-slate-700 mb-2 pb-2 border-b border-slate-200">
                    <i class="fas fa-map-marker-alt text-rose-500 mr-2"></i>
                    <span class="font-semibold text-sm">Lantai <?php echo $t->lantai; ?> - <?php echo $t->nama_ruangan; ?></span>
                </div>
                <?php if($t->nama_asset): ?>
                <div class="flex items-center text-slate-700 mb-2 pb-2 border-b border-slate-200">
                    <i class="fas fa-laptop text-emerald-500 mr-2"></i>
                    <span class="font-semibold text-sm text-emerald-700"><?php echo $t->nama_asset; ?></span>
                </div>
                <?php endif; ?>
                <p class="text-slate-600 text-sm leading-relaxed"><?php echo $t->deskripsi_masalah; ?></p>
            </div>
            
            <?php if($t->foto_kerusakan): ?>
            <div class="flex items-center">
                <a href="<?php echo base_url('uploads/'.$t->foto_kerusakan); ?>" target="_blank" class="inline-flex items-center text-sm font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition">
                    <i class="fas fa-image mr-2"></i> Lihat Foto Bukti
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Card Footer / Actions -->
        <?php if($t->status_tiket == 'Menunggu'): ?>
        <div class="p-4 bg-white border-t border-slate-100 flex gap-2">
            <a href="<?php echo base_url('staf/menuju_lokasi/'.$t->id_tiket); ?>" onclick="return confirm('Tandai bahwa Anda sedang menuju lokasi?')" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white flex justify-center items-center py-2.5 rounded-lg font-semibold transition shadow-sm hover:shadow">
                <i class="fas fa-walking mr-2"></i> Menuju Lokasi
            </a>
            <a href="<?php echo base_url('staf/hapus_spam/'.$t->id_tiket); ?>" onclick="return confirm('Yakin ini adalah tiket duplikat (spam) dan ingin dihapus?')" class="flex-none bg-rose-50 hover:bg-rose-100 text-rose-600 px-4 py-2.5 rounded-lg font-semibold transition border border-rose-100" title="Tandai Spam">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
        <?php elseif($t->status_tiket == 'Menuju Lokasi'): ?>
        <div class="p-4 bg-white border-t border-slate-100">
            <a href="<?php echo base_url('staf/kerjakan/'.$t->id_tiket); ?>" onclick="return confirm('Mulai kerjakan tiket ini?')" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2.5 rounded-lg font-semibold transition shadow-sm hover:shadow">
                <i class="fas fa-tools mr-2"></i> Mulai Dikerjakan
            </a>
        </div>
        <?php elseif($t->status_tiket == 'Dikerjakan'): ?>
        <div class="p-4 bg-white border-t border-slate-100">
            <a href="<?php echo base_url('staf/selesaikan/'.$t->id_tiket); ?>" onclick="return confirm('Tandai tiket ini sebagai Selesai?')" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white text-center py-2.5 rounded-lg font-semibold transition shadow-sm hover:shadow">
                <i class="fas fa-check-circle mr-2"></i> Tandai Selesai
            </a>
        </div>
        <?php else: ?>
        <div class="p-4 bg-emerald-50 border-t border-emerald-100 text-center">
            <span class="inline-flex items-center text-emerald-700 font-bold text-sm">
                <i class="fas fa-clipboard-check mr-2 text-lg"></i> DISELESAIKAN PADA <?php echo date('d M, H:i', strtotime($t->waktu_selesai)); ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
