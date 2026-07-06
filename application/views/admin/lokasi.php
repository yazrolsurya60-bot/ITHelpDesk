<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Manajemen Lokasi</h2>
    <p class="text-slate-500">Kelola data lantai dan ruangan untuk penempatan aset dan laporan kendala.</p>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 relative overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari lantai atau nama ruangan..." 
                   class="w-full border border-slate-200 bg-slate-50 rounded-full pl-11 pr-4 py-2.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 placeholder-slate-400">
        </div>
        
        <button onclick="openTambahModal()" class="w-full md:w-auto bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-600/20 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tambah Lokasi
        </button>
    </div>
    

    <!-- Table Section -->
    <div class="overflow-x-auto rounded-2xl border border-slate-100">
        <table class="w-full text-left border-collapse" id="dataTable">
            <thead>
                <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                    <th class="px-6 py-4 font-bold">Lantai</th>
                    <th class="px-6 py-4 font-bold">Nama Ruangan</th>
                    <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($locations)): ?>
                    <tr id="noDataRow">
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-map-marked-alt text-4xl mb-3 opacity-50"></i>
                                <p class="font-medium">Belum ada lokasi tersimpan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                
                <?php foreach($locations as $l): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors data-row">
                    <td class="px-6 py-4 font-semibold text-slate-900 col-lantai"><?php echo $l->lantai; ?></td>
                    <td class="px-6 py-4 text-slate-600 font-medium col-ruang"><?php echo $l->nama_ruangan; ?></td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button onclick="openEditModal(<?php echo $l->id_lokasi; ?>, '<?php echo htmlspecialchars($l->lantai, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($l->nama_ruangan, ENT_QUOTES); ?>')" 
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors tooltip-btn" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <a href="<?php echo base_url('admin/delete_lokasi/'.$l->id_lokasi); ?>" 
                               onclick="return confirm('Yakin hapus lokasi ini? Aset atau laporan terkait lokasi ini mungkin akan kehilangan referensi.');" 
                               class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-colors tooltip-btn" title="Hapus">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <?php if(isset($pagination) && !empty($pagination)): ?>
        <?php echo $pagination; ?>
    <?php endif; ?>
</div>

<!-- Modal Tambah -->
<div id="tambahModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden z-[60] p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300" id="tambahModalContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Tambah Lokasi</h3>
                <button onclick="closeTambahModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/add_lokasi'); ?>" method="POST" class="space-y-5">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Lantai</label>
                    <input type="text" name="lantai" placeholder="Contoh: Lantai 1" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" placeholder="Contoh: Ruang Meeting A" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeTambahModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden z-[60] p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300" id="editModalContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Edit Lokasi</h3>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/update_lokasi'); ?>" method="POST" class="space-y-5">
                <input type="hidden" name="id_lokasi" id="edit-id">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Lantai</label>
                    <input type="text" name="lantai" id="edit-lantai" placeholder="Contoh: Lantai 1" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="edit-ruangan" placeholder="Contoh: Ruang Meeting A" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Smooth Modal Animations
    function openTambahModal() {
        const modal = document.getElementById('tambahModal');
        const content = document.getElementById('tambahModalContent');
        modal.classList.remove('hidden');
        // Trigger reflow
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
    }
    
    function closeTambahModal() {
        const modal = document.getElementById('tambahModal');
        const content = document.getElementById('tambahModalContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function openEditModal(id, lantai, ruang) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-lantai').value = lantai;
        document.getElementById('edit-ruangan').value = ruang;
        
        const modal = document.getElementById('editModal');
        const content = document.getElementById('editModalContent');
        modal.classList.remove('hidden');
        // Trigger reflow
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
    }
    
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        const content = document.getElementById('editModalContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#dataTable tbody tr.data-row");
        let hasVisibleRow = false;
        
        rows.forEach(row => {
            let lantai = row.querySelector(".col-lantai").innerText.toLowerCase();
            let ruang = row.querySelector(".col-ruang").innerText.toLowerCase();
            if (lantai.includes(input) || ruang.includes(input)) {
                row.style.display = "";
                hasVisibleRow = true;
            } else {
                row.style.display = "none";
            }
        });
        
        const noDataRow = document.getElementById('noDataRow');
        if (noDataRow) {
            noDataRow.style.display = hasVisibleRow ? 'none' : '';
        }
    }
</script>
