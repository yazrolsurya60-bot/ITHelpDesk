<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Manajemen User</h2>
    <p class="text-slate-500">Kelola akses sistem untuk karyawan, staf IT, dan administrator.</p>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 mb-8 relative overflow-hidden">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama atau username..." 
                   class="w-full border border-slate-200 bg-slate-50 rounded-full pl-11 pr-4 py-2.5 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900 placeholder-slate-400">
        </div>
        
        <button onclick="openTambahModal()" class="w-full md:w-auto bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold hover:bg-emerald-600 transition-colors shadow-lg shadow-emerald-600/20 flex items-center justify-center">
            <i class="fas fa-user-plus mr-2"></i> Tambah User
        </button>
    </div>
    

    <!-- Tabel User -->
    <div class="overflow-x-auto rounded-2xl border border-slate-100">
        <table class="w-full text-left border-collapse" id="dataTable">
            <thead>
                <tr class="bg-emerald-600/10 text-emerald-600 text-xs uppercase tracking-widest border-b border-emerald-600/20">
                    <th class="px-6 py-4 font-bold text-center w-20">Foto</th>
                    <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                    <th class="px-6 py-4 font-bold">Username</th>
                    <th class="px-6 py-4 font-bold">Role</th>
                    <th class="px-6 py-4 font-bold">Spesialisasi</th>
                    <th class="px-6 py-4 font-bold">Status Kehadiran</th>
                    <th class="px-6 py-4 font-bold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($users)): ?>
                    <tr id="noDataRow">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-users text-4xl mb-3 opacity-50"></i>
                                <p class="font-medium">Belum ada user tersimpan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                
                <?php foreach($users as $u): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50/80 transition-colors data-row">
                    <td class="px-6 py-4 flex justify-center items-center">
                        <?php 
                            $initial = strtoupper(substr($u->nama_lengkap, 0, 1));
                            if(!empty($u->foto) && file_exists('./uploads/profil/' . $u->foto)): 
                        ?>
                            <img src="<?php echo base_url('uploads/profil/' . $u->foto); ?>" alt="Foto" class="w-10 h-10 rounded-full object-cover border-2 border-emerald-500/20 shadow-sm">
                        <?php else: ?>
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center border-2 border-emerald-500/20 shadow-sm">
                                <?php echo $initial; ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-900 col-nama"><?php echo $u->nama_lengkap; ?></td>
                    <td class="px-6 py-4 text-slate-500 font-medium col-username">@<?php echo $u->username; ?></td>
                    <td class="px-6 py-4">
                        <?php if($u->role == 'Admin'): ?>
                            <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-bold rounded-full border border-rose-200 tracking-wider">ADMIN</span>
                        <?php elseif($u->role == 'Staf_IT'): ?>
                            <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-full border border-indigo-200 tracking-wider">STAF IT</span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-full border border-slate-200 tracking-wider">KARYAWAN</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-slate-600 font-medium"><?php echo $u->spesialisasi ? $u->spesialisasi : '<span class="text-slate-400 font-normal italic">-</span>'; ?></td>
                    <td class="px-6 py-4">
                        <?php if($u->role == 'Staf_IT'): ?>
                            <?php if($u->status_kehadiran == 'Aktif'): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-600/10 text-emerald-600 text-xs font-bold rounded-full border border-emerald-600/20"><div class="w-1.5 h-1.5 bg-emerald-600 rounded-full"></div>Aktif</span>
                            <?php elseif($u->status_kehadiran == 'Sakit'): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 text-xs font-bold rounded-full border border-amber-200"><div class="w-1.5 h-1.5 bg-amber-500 rounded-full"></div>Sakit</span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-600 text-xs font-bold rounded-full border border-rose-200"><div class="w-1.5 h-1.5 bg-rose-500 rounded-full"></div>Cuti</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-slate-400 font-normal italic">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button onclick="openEditModal(<?php echo $u->id_user; ?>, '<?php echo htmlspecialchars($u->nama_lengkap, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($u->username, ENT_QUOTES); ?>', '<?php echo $u->role; ?>', '<?php echo $u->spesialisasi_id; ?>', '<?php echo $u->status_kehadiran; ?>')" 
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-colors tooltip-btn" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <a href="<?php echo base_url('admin/delete_user/'.$u->id_user); ?>" 
                               onclick="return confirm('Yakin hapus user ini?');" 
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

<!-- Modal Tambah User -->
<div id="tambahModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden z-[60] p-4 overflow-y-auto transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="tambahModalContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Tambah User Baru</h3>
                <button onclick="closeTambahModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/add_user'); ?>" method="POST" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Username</label>
                        <input type="text" name="username" required 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Password</label>
                        <input type="password" name="password" required 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Role</label>
                        <select name="role" id="role-select" required 
                                class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                            <option value="Karyawan">Karyawan</option>
                            <option value="Staf_IT">Staf IT</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
                
                <div id="spesialisasi-container" class="hidden bg-slate-50/50 p-5 rounded-2xl border border-slate-100">
                    <label class="block text-sm font-bold text-slate-900 mb-2">Spesialisasi Kategori (Khusus Staf IT)</label>
                    <select name="spesialisasi_id" id="spesialisasi-select" 
                            class="w-full border border-slate-200 bg-white rounded-2xl px-5 py-3 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                        <option value="">-- Pilih Spesialisasi --</option>
                        <?php foreach($categories as $c): ?>
                        <option value="<?php echo $c->id_kategori; ?>"><?php echo $c->nama_kategori; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Digunakan untuk auto-routing tiket bantuan ke staf ini.</p>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeTambahModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div id="editModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center hidden z-[60] p-4 overflow-y-auto transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden transform scale-95 transition-transform duration-300" id="editModalContent">
        <div class="p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-extrabold text-slate-900">Edit User</h3>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="<?php echo base_url('admin/update_user'); ?>" method="POST" class="space-y-5">
                <input type="hidden" name="id_user" id="edit-id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit-nama" required 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Username</label>
                        <input type="text" name="username" id="edit-username" required 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Password</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tak diubah" 
                               class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-900">Role</label>
                        <select name="role" id="edit-role-select" required 
                                class="w-full border border-slate-200 bg-slate-50 rounded-2xl px-5 py-3 outline-none focus:bg-white focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                            <option value="Karyawan">Karyawan</option>
                            <option value="Staf_IT">Staf IT</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>
                
                <div id="edit-spesialisasi-container" class="hidden bg-slate-50/50 p-5 rounded-2xl border border-slate-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-900">Spesialisasi Kategori</label>
                            <select name="spesialisasi_id" id="edit-spesialisasi-select" 
                                    class="w-full border border-slate-200 bg-white rounded-2xl px-5 py-3 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                                <option value="">-- Pilih Spesialisasi --</option>
                                <?php foreach($categories as $c): ?>
                                <option value="<?php echo $c->id_kategori; ?>"><?php echo $c->nama_kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-900">Status Kehadiran</label>
                            <select name="status_kehadiran" id="edit-status-kehadiran" 
                                    class="w-full border border-slate-200 bg-white rounded-2xl px-5 py-3 outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 transition-all font-medium text-slate-900">
                                <option value="Aktif">Aktif</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Cuti">Cuti</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-3 font-medium">Jika diset Sakit/Cuti, sistem auto-assign tidak akan menugaskan tiket baru ke staf ini.</p>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-full font-bold hover:bg-slate-200 transition-colors">Batal</button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-full font-bold hover:bg-emerald-600 shadow-lg shadow-emerald-600/20 transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Logic form
    document.getElementById('role-select').addEventListener('change', function() {
        var container = document.getElementById('spesialisasi-container');
        var select = document.getElementById('spesialisasi-select');
        if (this.value === 'Staf_IT') {
            container.classList.remove('hidden');
            select.setAttribute('required', 'required');
        } else {
            container.classList.add('hidden');
            select.removeAttribute('required');
        }
    });

    document.getElementById('edit-role-select').addEventListener('change', function() {
        var container = document.getElementById('edit-spesialisasi-container');
        if (this.value === 'Staf_IT') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    });

    // Modals
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
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function openEditModal(id, nama, username, role, spesialisasi_id, status_kehadiran) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-username').value = username;
        
        var roleSelect = document.getElementById('edit-role-select');
        roleSelect.value = role;
        roleSelect.dispatchEvent(new Event('change'));
        
        if(role === 'Staf_IT') {
            document.getElementById('edit-spesialisasi-select').value = spesialisasi_id;
            document.getElementById('edit-status-kehadiran').value = status_kehadiran;
        }
        
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
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    function filterTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#dataTable tbody tr.data-row");
        let hasVisibleRow = false;
        
        rows.forEach(row => {
            let nama = row.querySelector(".col-nama").innerText.toLowerCase();
            let uname = row.querySelector(".col-username").innerText.toLowerCase();
            if (nama.includes(input) || uname.includes(input)) {
                row.style.display = "";
                hasVisibleRow = true;
            } else {
                row.style.display = "none";
            }
        });
        
        const noDataRow = document.getElementById('noDataRow');
        if(noDataRow) noDataRow.style.display = hasVisibleRow ? 'none' : '';
    }
</script>
