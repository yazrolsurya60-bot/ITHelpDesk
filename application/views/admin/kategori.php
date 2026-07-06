<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Manajemen Kategori</h2>
    <p class="text-slate-500">Kelola kategori kendala untuk memudahkan pelaporan dan distribusi tiket.</p>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 relative overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari kategori..." 
                   class="w-full border border-slate-200 bg-slate-50 rounded-full pl-11 pr-4 py-2.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 placeholder-slate-400">
        </div>
        
        <button onclick="openTambahModal()" class="w-full md:w-auto bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-600/20 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tambah Kategori
        </button>
    </div>
    

    <!-- Table Section -->
    <div class="overflow-x-auto rounded-2xl border border-slate-100">
        <table class="w-full text-left border-collapse" id="dataTable">
            <thead>
                <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                    <th class="px-6 py-4 font-bold">Nama Kategori</th>
                    <th class="px-6 py-4 font-bold">Deskripsi</th>
                    <th class="px-6 py-4 font-bold text-center">Terkait Aset?</th>
                    <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($categories)): ?>
                    <tr id="noDataRow">
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-layer-group text-4xl mb-3 opacity-50"></i>
                                <p class="font-medium">Belum ada kategori tersimpan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                
                <?php foreach($categories as $c): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors data-row">
                    <td class="px-6 py-4 font-semibold text-slate-900 col-nama"><?php echo $c->nama_kategori; ?></td>
                    <td class="px-6 py-4 text-slate-600 font-medium col-desk"><?php echo $c->deskripsi_kategori; ?></td>
                    <td class="px-6 py-4 text-center">
                        <?php if($c->has_asset): ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-600/10 text-emerald-600 text-xs font-bold rounded-full border border-emerald-600/20">
                                <i class="fas fa-check"></i> Ya
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full border border-slate-200">
                                <i class="fas fa-minus"></i> Tidak
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button onclick="openEditModal(<?php echo $c->id_kategori; ?>, '<?php echo htmlspecialchars($c->nama_kategori, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($c->deskripsi_kategori, ENT_QUOTES); ?>', <?php echo $c->has_asset; ?>)" 
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors tooltip-btn" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <a href="<?php echo base_url('admin/delete_kategori/'.$c->id_kategori); ?>" 
                               onclick="return confirm('Yakin hapus kategori ini?');" 
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
</div>

<!-- Modal Tambah -->
<div id="tambahModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden z-[60] p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform scale-95 transition-transform duration-300" id="tambahModalContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Tambah Kategori</h3>
                <button onclick="closeTambahModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/add_kategori'); ?>" method="POST" class="space-y-5">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Kategori</label>
                    <input type="text" name="nama_kategori" required placeholder="Cth: Hardware, Jaringan..."
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Deskripsi</label>
                    <textarea name="deskripsi_kategori" rows="3" required placeholder="Jelaskan jenis kendala ini..."
                              class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 resize-none"></textarea>
                </div>
                <!-- Toggle has_asset -->
                <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">Dapat Dikaitkan Aset?</p>
                        <p class="text-[11px] text-slate-500 mt-1 font-medium">Aktifkan jika pelapor perlu memilih aset terkait.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="has_asset" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-600/20 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transition-all peer-checked:translate-x-5"></div>
                    </label>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeTambahModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Kategori</button>
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
                <h3 class="text-xl font-extrabold text-slate-900">Edit Kategori</h3>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/update_kategori'); ?>" method="POST" class="space-y-5">
                <input type="hidden" name="id_kategori" id="edit-id">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="edit-nama" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Deskripsi</label>
                    <textarea name="deskripsi_kategori" id="edit-desk" rows="3" required 
                              class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 resize-none"></textarea>
                </div>
                <!-- Toggle has_asset -->
                <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">Dapat Dikaitkan Aset?</p>
                        <p class="text-[11px] text-slate-500 mt-1 font-medium">Aktifkan jika pelapor perlu memilih aset terkait.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="has_asset" id="edit-has-asset" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-600/20 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transition-all peer-checked:translate-x-5"></div>
                    </label>
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

    function openEditModal(id, nama, desk, hasAsset) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-desk').value = desk;
        document.getElementById('edit-has-asset').checked = hasAsset == 1;
        
        const modal = document.getElementById('editModal');
        const content = document.getElementById('editModalContent');
        modal.classList.remove('hidden');
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
            let nama = row.querySelector(".col-nama").innerText.toLowerCase();
            let desk = row.querySelector(".col-desk").innerText.toLowerCase();
            if (nama.includes(input) || desk.includes(input)) {
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
