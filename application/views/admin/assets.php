<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Inventaris Aset IT</h2>
    <p class="text-slate-500">Kelola dan pantau seluruh perangkat keras, lisensi, dan infrastruktur IT.</p>
</div>


<!-- Stats Row -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Kondisi Baik -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-600/5 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-emerald-600/10 transition-colors duration-500"></div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Kondisi Baik</p>
                <h3 class="text-4xl font-extrabold text-slate-900 tracking-tighter"><?php echo $total_baik; ?></h3>
            </div>
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-emerald-600 shadow-sm border border-slate-100">
                <i class="fas fa-check-circle text-xl"></i>
            </div>
        </div>
    </div>
    <!-- Rusak -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-rose-50 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-rose-100 transition-colors duration-500"></div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Kondisi Rusak</p>
                <h3 class="text-4xl font-extrabold text-slate-900 tracking-tighter"><?php echo $total_rusak; ?></h3>
            </div>
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-rose-500 shadow-sm border border-slate-100">
                <i class="fas fa-times-circle text-xl"></i>
            </div>
        </div>
    </div>
    <!-- Dalam Perbaikan -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-full blur-2xl -mr-8 -mt-8 group-hover:bg-amber-100 transition-colors duration-500"></div>
        <div class="relative z-10 flex items-start justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Dalam Perbaikan</p>
                <h3 class="text-4xl font-extrabold text-slate-900 tracking-tighter"><?php echo $total_perbaikan; ?></h3>
            </div>
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-amber-500 shadow-sm border border-slate-100">
                <i class="fas fa-tools text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 relative overflow-hidden">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            <input type="text" id="searchAsset" onkeyup="filterTable('searchAsset','assetTable')" placeholder="Cari aset..." 
                   class="w-full border border-slate-200 bg-slate-50 rounded-full pl-11 pr-4 py-2.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 placeholder-slate-400">
        </div>
        
        <button onclick="openTambahModal()" class="w-full md:w-auto bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-600/20 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> Tambah Aset
        </button>
    </div>
    
    <div class="overflow-x-auto rounded-2xl border border-slate-100">
        <table class="w-full text-left border-collapse" id="assetTable">
            <thead>
                <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                    <th class="px-6 py-4 font-bold">Nama Aset</th>
                    <th class="px-6 py-4 font-bold">Jenis</th>
                    <th class="px-6 py-4 font-bold">Lokasi</th>
                    <th class="px-6 py-4 font-bold">No. Seri</th>
                    <th class="px-6 py-4 font-bold">Kondisi</th>
                    <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($assets)): ?>
                <tr id="noDataRow">
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <i class="fas fa-boxes text-4xl mb-3 opacity-50"></i>
                            <p class="font-medium">Belum ada data aset. Tambahkan aset pertama Anda.</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
                
                <?php foreach($assets as $a): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-semibold text-slate-900"><?php echo $a->nama_asset; ?></td>
                    <td class="px-6 py-4 text-slate-600 font-medium"><?php echo $a->jenis_asset; ?></td>
                    <td class="px-6 py-4 text-slate-600 font-medium">
                        <?php echo $a->lantai ? 'Lantai '.$a->lantai.' - '.$a->nama_ruangan : '<span class="text-slate-400 italic font-normal">-</span>'; ?>
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-mono text-xs"><?php echo $a->no_seri ?: '-'; ?></td>
                    <td class="px-6 py-4">
                        <?php if($a->kondisi == 'Baik'): ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-600/10 text-emerald-600 text-xs font-bold rounded-full border border-emerald-600/20">
                                Baik
                            </span>
                        <?php elseif($a->kondisi == 'Rusak'): ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-600 text-xs font-bold rounded-full border border-rose-200">
                                Rusak
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-full border border-amber-200">
                                Perbaikan
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button onclick='openEditModal(<?php echo json_encode($a); ?>)' 
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors tooltip-btn" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <a href="<?php echo base_url('admin/delete_asset/'.$a->id_asset); ?>" 
                               onclick="return confirm('Yakin hapus aset ini?')" 
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
<div id="modalTambah" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-[60] hidden p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300" id="modalTambahContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Tambah Aset Baru</h3>
                <button onclick="closeTambahModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php echo form_open('admin/add_asset', ['class' => 'space-y-5']); ?>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Aset *</label>
                    <input type="text" name="nama_asset" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Jenis Aset *</label>
                    <input type="text" name="jenis_asset" required placeholder="Komputer, Printer..." 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Lokasi</label>
                    <select name="lokasi_id" class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php foreach($locations as $l): ?>
                        <option value="<?php echo $l->id_lokasi; ?>">Lantai <?php echo $l->lantai; ?> - <?php echo $l->nama_ruangan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">No. Seri</label>
                    <input type="text" name="no_seri" 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-900">Kondisi *</label>
                <select name="kondisi" class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-900">Keterangan</label>
                <textarea name="keterangan" rows="2" 
                          class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 resize-none"></textarea>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeTambahModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Aset</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-[60] hidden p-4 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300" id="modalEditContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Edit Aset</h3>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php echo form_open('admin/update_asset', ['class' => 'space-y-5']); ?>
            <input type="hidden" name="id_asset" id="edit_id_asset">
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Nama Aset *</label>
                    <input type="text" name="nama_asset" id="edit_nama_asset" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Jenis Aset *</label>
                    <input type="text" name="jenis_asset" id="edit_jenis_asset" required 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">Lokasi</label>
                    <select name="lokasi_id" id="edit_lokasi_id" class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php foreach($locations as $l): ?>
                        <option value="<?php echo $l->id_lokasi; ?>">Lantai <?php echo $l->lantai; ?> - <?php echo $l->nama_ruangan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-900">No. Seri</label>
                    <input type="text" name="no_seri" id="edit_no_seri" 
                           class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-900">Kondisi *</label>
                <select name="kondisi" id="edit_kondisi" class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                </select>
            </div>
            
            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-900">Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" rows="2" 
                          class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 resize-none"></textarea>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Perubahan</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    // Smooth Modal Animations
    function openTambahModal() {
        const modal = document.getElementById('modalTambah');
        const content = document.getElementById('modalTambahContent');
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
    }
    
    function closeTambahModal() {
        const modal = document.getElementById('modalTambah');
        const content = document.getElementById('modalTambahContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function openEditModal(asset) {
        document.getElementById('edit_id_asset').value  = asset.id_asset;
        document.getElementById('edit_nama_asset').value = asset.nama_asset;
        document.getElementById('edit_jenis_asset').value = asset.jenis_asset;
        document.getElementById('edit_lokasi_id').value  = asset.lokasi_id || '';
        document.getElementById('edit_no_seri').value    = asset.no_seri || '';
        document.getElementById('edit_kondisi').value    = asset.kondisi;
        document.getElementById('edit_keterangan').value = asset.keterangan || '';
        
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalEditContent');
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
    }
    
    function closeEditModal() {
        const modal = document.getElementById('modalEdit');
        const content = document.getElementById('modalEditContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function filterTable(inputId, tableId) {
        const q = document.getElementById(inputId).value.toLowerCase();
        let hasVisibleRow = false;
        document.querySelectorAll('#'+tableId+' tbody tr:not(#noDataRow)').forEach(row => {
            if(row.textContent.toLowerCase().includes(q)) {
                row.style.display = '';
                hasVisibleRow = true;
            } else {
                row.style.display = 'none';
            }
        });
        
        const noDataRow = document.getElementById('noDataRow');
        if(noDataRow) {
            noDataRow.style.display = hasVisibleRow ? 'none' : '';
        }
    }
</script>
